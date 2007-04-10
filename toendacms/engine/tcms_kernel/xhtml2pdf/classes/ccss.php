<?php

# Emulation de la fonction php 4.3.0 file_get_contents.
if (!function_exists('file_get_contents')){

  function file_get_contents($file) {
    
    $fp = fopen($file, 'r');
    $content = fread($fp, filesize('test.css'));
    fclose ($fp);  
  
    return $content;
  }

}

class ccss {
  
  # Init des vars.
  var $cssdata = array();
  
  # Lecture du fichier css $file
  function read($data)
  {
    # recuperation du fichier css.
    /*if (file_exists($file))
      $content = file_get_contents($file);
    else
      return -1;*/
    $this->content = $data;
    
    # Regex pour obtenir ce qu'il faut.
    preg_match_all('`([a-zA-Z0-9_, -]+)[[:space:]]+{(.*?)}`s', $this->content, $this->matches, PREG_SET_ORDER);
    
    # Parcours des resultats.
    foreach($this->matches as $match){
    
      # Separation des resultats.
      list($total, $classnames, $data) = $match;
      $this->styles = explode(';', $data);
      
      $this->classnames= explode(',',$classnames);
      
      foreach($this->classnames as $classname){
        # Suprimer les espaces. Apres cette action, si la ligne contenant des infos, sa longueur > 0
        $this->classname = trim($classname);

        if (strlen($this->classname) > 0){        
          foreach ($this->styles as $style) {
            # Suprimer les espaces. Apres cette action, si la ligne contenant des infos, sa longueur > 0
            $this->style = trim($style);
			//var_dump($this->style  );
            if (strlen($this->style) > 0){
              list($attribute, $value) = explode(':', $this->style);
        
              # Insertion des infos dans le tableau après nettoyage des blanks.
              $this->cssdata[strtolower($this->classname)][strtolower(trim($attribute))] = strtolower(trim($value));
            }
          }
        }
      }
    }  
  }
  
  # Affichage d'un attribut.
  function GetAttribute($classname, $attrname) {
    if (isset($this->cssdata[$classname][$attrname]))
      return $this->cssdata[$classname][$attrname];
    else
      return -1;
  }
  
  # Affichage d'un attribut.
  function UpdateAttribute($classname, $attrname, $value) {
    return $this->cssdata[$classname][$attrname] = $value;
  }  
  
}

?>
