<?php

function extract_color($color){
    # Le plus courant.
    if(strlen($color) == 7){
        return array(base_convert(substr($color,1,2),16,10),base_convert(substr($color,3,2),16,10),base_convert(substr($color,5,2),16,10));
    }
    # le deuxieme tres courant. Noté comme c'est gore.
    if(strlen($color) == 4){
        return array(base_convert(str_repeat(substr($color,1,1),2),16,10),base_convert(str_repeat(substr($color,2,1),2),16,10),base_convert(str_repeat(substr($color,3,1),2),16,10));
    }
    # et la regex pour finir.
    if(preg_match('`rgb *\( *([0-9]{1,3}) *, *([0-9]{1,3}) *, *([0-9]{1,3}) *\)`i',$color,$match)){
        return array($match[1],$match[2],$match[3]);
    }
}

function converttomm($size)
{
  
  if ($size != 0) {
    preg_match('`([0-9,\.]+)(px|cm|pt|mm)?`', $size, $matches);
        
    if (isset($matches[2]))
      $unite = $matches[2];
    else
      $unite = '';
    
    $valeur = $matches[1]; 
    
    if ($unite == 'cm')
      $size = $valeur*10;
    elseif ($unite == 'px')
      $size = $valeur * 19/80; # On se dit que 800px font une largeur de page (19cm)
    elseif ($unite == 'mm')
      $size = $valeur;
    elseif ($unite == 'pt')
      $size = $valeur*25.4/72;
    else
      $size = 0;
  }
  
  return $size;
}

?>