<?php

define('DRWEB_AUTHORS_ACVTIVE_MAX_POST_AGE_DAYS', 90);
define('DRWEB_AUTHORS_ACTIVE_MIN_POST_COUNT', 1);

/**
 * @param array $allAuthors
 * @return array
 */
function drweb_authors_get_active_authors(array $allAuthors) {

	// get posts with date after max age
	$authors = array();
	$query = new WP_Query(array(
		'post_type' => 'post',
		'date_query' => array(
			array(
				'after' => date('c', time() - (60 * 60 * 24 * DRWEB_AUTHORS_ACVTIVE_MAX_POST_AGE_DAYS)),
				'inclusive' => true,
			)
		)
	));

	// count post per user
	$userPostCount = array();
	while ($query->have_posts()) {
		$query->the_post();
		$userID = $query->post->post_author;
		if (!isset($userPostCount[$userID])) {
			$userPostCount[$userID] = 0;
		}
		$userPostCount[$userID]++;
	}

	// filter users by post count
	$users = $allAuthors;
	foreach ($users as $user) {
		if ($userPostCount[$user->ID] >= DRWEB_AUTHORS_ACTIVE_MIN_POST_COUNT) {
			$authors[] = $user;
		}
	}

	// sort users alphabetically by display name
	usort($authors, function ($a, $b) {
		return strcasecmp($a->data->display_name, $b->data->display_name);
	});
	
	// Reset post data (otherwise strange effects would occur since we the loop
	// has been changed by above code)
	wp_reset_postdata();

	return $authors;
}

/**
 * @param array $allAuthors
 * @param array $activeAuthors
 * @return array
 */
function drweb_authors_get_inactive_authors(array $allAuthors, array $activeAuthors) {
	$authors = array();
	// inactive -> all users not in active authors list
	foreach ($allAuthors as $author) {
		if (!in_array($author, $activeAuthors)) {
			$authors[] = $author;
		}
	}
	return $authors;
}

/**
 * @return string
 */
function drweb_authors_func() {
	$allAuthors = get_users('orderby=display_name&who=authors&orderby=post_count&order=DESC');
	$activeAuthors = drweb_authors_get_active_authors($allAuthors);
	$inactiveAuthors = drweb_authors_get_inactive_authors($allAuthors, $activeAuthors);
	// start html output
	ob_start();
	?>

	<h2>Alle aktiven Autoren</h2>
	<ul class="l-stack">
		<?php foreach ($activeAuthors as $author): ?>
			<li>
				<div class="drweb-authors clearfix">
					<div class="drweb-authors__image">
						<a href="<?= get_author_posts_url($author->ID, $author->data->nicename) ?>">
							<?= get_avatar($author->ID, 150) ?>
						</a>
					</div>
					<div class="drweb-authors__text">
						<h3><a href="<?= get_author_posts_url($author->ID, $author->data->nicename) ?>"><?= $author->data->display_name ?></a></h3>
						<p><?= get_the_author_meta('description', $author->ID) ?></p>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>

	<h2>Alle Autoren</h2>
	<ul class="l-stack l-stack--inline">
		<?php foreach ($inactiveAuthors as $author): ?>
			<li>
				<a href="<?= get_author_posts_url($author->ID, $author->data->nicename) ?>">
					<?= get_avatar($author->ID, 100) ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>

	<h2>Alle Autoren nach Beitragszahl</h2>
	<ul class="l-stack all">
		<?php foreach ($allAuthors as $author): ?>
			<?php $postCount = count_user_posts($author->ID); ?>
			<?php if ($postCount > 0): ?>
				<li>
					<a href="<?= get_author_posts_url($author->ID, $author->data->nicename) ?>">
						<?= $author->data->display_name ?> (<?= $postCount ?>)
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php
	return ob_get_clean();
}