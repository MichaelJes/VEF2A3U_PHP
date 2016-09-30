
<?php
  # checking the $_POST variables for required
  # fields that have been left blank. Strip any default code inserted by your editor,
  
  # Förum í allar name breytur í forminu ($_POST array)
  foreach ($_POST as $key => $value) {
  
  // assign to temporary variable and strip whitespace if not an array
  # Notum trim á input textareiti (þurfum ekki að checka á radio buttons,checkboxes eða <select> sem eru arrays)
  # trim býst við string og við notum það til að hreinsa autt bil vinstra og hægra megin við 
  # texta úr input reit frá notanda.
  $temp = is_array($value) ? $value : trim($value);
  

  
  // if empty and required, add to $missing array
  # Ef reitur er tómur og í reit sem er nauðsynlegur skv. $required array sem við bjuggum til (name breytuheitin)
  # in_array() fyrri param. er leitarskilyrðið (name breytuvísun) á array sem er síðari param. Skilar TRUE/FALSE 
  if (empty($temp) && in_array($key, $required)) {
	   $missing[] = $key;
     # set keys's name value to an empty string
     ${$key} = '';
  } 
  
  # athugum hvort þá að gögn séu að koma frá öðrum input textareitum frá okkar formi (öryggisatriði).
  elseif (in_array($key, $expected)) {
	
  // php validation
    $temp = filter_var($temp, FILTER_SANITIZE_STRING);
  $temp = htmlentities($temp);


  // otherwise, assign to a variable of the same name as $key
  # we are creating variables dynamically
  # færum úr post array yfir í breytur til að nota áfram.
	
	# Skilgreinum breytu sem á að heita sama og lykill (name breytan) og sem geymir svo gildið sem er í $temp  (input reit) 
	# dæmi:  önnur name breytan í forminu heitir email (name="email") hún samsvarar key í $_POST[] array
	# name vísar á gildi sem er í input reit. sama og að gera:  $email = ' innihald í inputreit frá name="email" ' 
	# sjá frekari útskýringu bls. 61 í kafla 3.

   ${$key} = $temp;
  }
}
