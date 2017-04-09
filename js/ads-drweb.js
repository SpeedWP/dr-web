AdsController.on('before-showad', function (zone, targetID) {
	this.log('before-showad: '+zone+', '+targetID);
	if (typeof tn_wap !== 'undefined' && tn_wap == 'true') {
		this.log('tn_wap detected, disabling skyscraper');
		this.disableZone('ad_skyscraper');
	}
	if (typeof OA_output[zone] !== 'undefined') {
		if (OA_output[zone].search('drweb_ads_no_skyscraper') != -1)
			this.disableZone('ad_skyscraper');
	}
});

// Remove sponsor widget if advertising is disabled
jQuery(document).ready(function ($) {
	if ($('body').hasClass('advertising-disabled')) {
		$('#sponsor-list').closest('.widget_text').remove();
	}
});