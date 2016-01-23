<?php

  $colours = array(
    "red"=>"#F44336",
    "purple"=>"#9C27B0", 
    "pink"=>"#E91E63", 
    "blue"=>"#4CA5FF",
    "green"=>"#71c100", 
    "yellow"=>"#FFC107", 
    "orange"=>"#FF9800",
  );

  function setGender($gender) { 
    if($gender == 0) { 
       return 'boy';
    } else { 
      return 'girl';
    }
  } 

  function ageCalculator($dob){
    if(!empty($dob)){
      $birthdate = new DateTime($dob);
      $today   = new DateTime('today');
      $age = $birthdate->diff($today)->y;
      return $age;
    } else {
      return 0;
    }
  }

  function setColour($val) {
    if ($val == 1) { 
      $col = 'theme-colour-lighten';
    } else if ($val == 2) {
      $col = 'theme-colour-darken';
    } else { 
      $col = '#eee';
    }
    return $col;
  }

  function formatGender($gender) { 
    if ($gender == 0) { 
      $msg = 'he';
    } else { 
      $msg = 'she';
    }
    return $msg; 
  }
  
?> 