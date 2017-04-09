OA_zones = {
'Medium Rectangle' : 17,
'Half Page Ad' : 74,
'Text Ad Article Page' : 75,
'Leaderboard' : 73,
'Skyscraper' : 55,
'Sponsor 1' : 16,
'Sponsor 2' : 16,
'Sponsor 3' : 16,
'Sponsor 4' : 16,
'Sponsor 5' : 16,
'Sponsor 6' : 16,
'Sponsor 7' : 16,
'Sponsor 8' : 16,
'Sponsor First' : 76,
'Medium Rectangle Startseite' : 78, 
'Layer Ad' : 83,
'Billboard' : 84,
'Artikelinhalt' : 96
}


  function shuffle(arr) {
    var i = arr.length;
  
  	if(i < 2) return;
  	do {
  		var ii = Math.floor(Math.random() * i);
  		var temp = arr[ii];
  		arr[ii] = arr[--i];
  		arr[i] = temp;
  	} while(i) 
  }
  
  function sm_print_adrow(name, prepend, append) {
    if (typeof(OA_output) === 'undefined') {
      return;
    }

    var list = [];
    
    var i = 1;
    while (typeof(OA_output[name+i.toString()]) !== 'undefined') {
      if (OA_output[name+i.toString()] != '')
        list.push(OA_output[name+i.toString()]);
      i++;
    }
    shuffle(list);
    
    for (i = 0; i < list.length; i++) {
      document.write(prepend+list[i]+append);
    }
  }
