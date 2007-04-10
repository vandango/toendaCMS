<?php
define('X_PATH_CLASS', X_PATH.'/classes');

include_once(X_PATH_CLASS.'/config.php');
include_once(X_PATH_CLASS.'/extendedfpdf.php');
include_once(X_PATH_CLASS.'/ccss.php');
include_once(X_PATH_CLASS.'/common_attrs_functions.php');

# Emulation de la fonction php 4.3.0 file_get_contents.
if (!function_exists('file_get_contents')){
  function file_get_contents($file) {
    $fp = fopen($file, 'r');
    $content = fread($fp, filesize(SH_PATH_TOOLS.'/test.css'));
    fclose ($fp);  

    return $content;
  }
}

class xhtml2pdf  extends XFPDF {

    var $xmlparser;
   var $currenttag;
   var $pdfdata;
   var $css;
   var $depth;
   var $databuffer;
   var $currentattr;
   var $attributes;
   var $link;
   var $readytodisplayablock;
   var $fontattr;
   var $bold;
   var $italic;
   var $underline;
   var $src_finished; 
   var $linethrough;
   var $about;
   var $align;
   var $cfg;

  function SetClassAttrAsCurrent($classname, $attrname, $herit=1)
  {
    //global $this->attrdefault; # config.php
  
    if ($this->css->GetAttribute($classname, $attrname) != -1) {
      # La valeur de l'attribut pour la classe a été clairement définie
      $this->currentattr[$this->depth][$attrname] = $this->css->GetAttribute($classname, $attrname);
    }
    else {
      if ($this->depth > 1 && isset($this->currentattr[($this->depth-1)][$attrname]) && $herit==1)
        # Sinon, on tente de l'hériter
        $this->currentattr[$this->depth][$attrname] = $this->currentattr[($this->depth-1)][$attrname];
      else 
        # Si pas d'héritage possible, on met une valeur par défaut
          $this->currentattr[$this->depth][$attrname] = $this->attrdefault[$attrname];
    }  
  }
  
  
  # Cette fonction, appelée normalement avant chaque sortie, va mettre en place les styles de currentattr[$depth]  
  function ApplyCurrentCssSettings()
  {
    //global $this->allowed;
    
    $this->bold = '';
    $this->italic = '';
    $this->underline = '';
    $this->linethrough = '';
    $this->align = '';
    
    if ($this->depth > 0) { 
    
      if ($this->allowed['color']) {
        list($r, $g, $b) = extract_color($this->currentattr[$this->depth]['color']);
        $this->SetTextColor($r, $g, $b); 
      }
    	
	  if( $this->allowed['font-family']  ) {
	  	$this->SetFont($this->currentattr[$this->depth]['font-family']);
	  }
	  
	  if ($this->allowed['font-style']) {
        if ($this->currentattr[$this->depth]['font-style'] == 'italic')
          $this->italic = 'I'; 
        else
          $this->italic = '';         
      } 
    	
      if ($this->allowed['font-size']) {
        $this->SetFontSize($this->currentattr[$this->depth]['font-size']); //
      }
      
      if ($this->allowed['font-weight']) {
        if ($this->currentattr[$this->depth]['font-weight'] == 'bolder' || $this->currentattr[$this->depth]['font-weight'] == 'bold')
          $this->bold = 'B';
        else
          $this->bold = '';        
      }

      if ($this->allowed['text-decoration']) {
        if ($this->currentattr[$this->depth]['text-decoration'] == 'underline')
          $this->underline = 'U';
        else
          $this->underline = ''; 
         
        if ($this->currentattr[$this->depth]['text-decoration'] == 'line-through')
          $this->linethrough = 'LT';
        else
          $this->linethrough = '';    
        
      } 
      $this->SetFont('', $this->bold.$this->underline.$this->linethrough.$this->italic, '');  //
            
      if ($this->allowed['text-transform']) {
        if ($this->currentattr[$this->depth]['text-transform'] == 'uppercase')
          $this->databuffer = strtoupper($this->databuffer);
        else 
        if ($this->currentattr[$this->depth]['text-transform'] == 'lowercase')
          $this->databuffer = strtolower($this->databuffer);      
        else 
        if ($this->currentattr[$this->depth]['text-transform'] == 'capitalize')
          $this->databuffer = ucwords($this->databuffer);   
      }
      
      if($this->allowed['text-align']) {
      	if($this->currentattr[$this->depth]['text-align'] == 'left') $this->align = 'L';
      	if($this->currentattr[$this->depth]['text-align'] == 'right') $this->align = 'R';
      	if($this->currentattr[$this->depth]['text-align'] == 'center') $this->align = 'C';
      	if($this->currentattr[$this->depth]['text-align'] == 'justify') $this->align = 'J';
      }
      
      if ($this->allowed['white-space']) {
        if ($this->currentattr[$this->depth]['white-space'] == 'normal') {
          $this->databuffer = str_replace("\n", ' ', $this->databuffer);
          $this->databuffer = preg_replace('`[[:space:]]+`', ' ', $this->databuffer);
        }          
      }
    }
  }
 
 
  function OutputBufferedData()
  {
    //global $this->attrdefault; # config.php
    //global $this->allowed; # config.php
	
    $this->ApplyCurrentCssSettings();

    if (isset($this->currentattr[$this->depth]['font-size']))
      $this->lineheight = XHTML2PDF_DEFLINESIZE*$this->currentattr[$this->depth]['font-size']/$this->attrdefault['font-size'];
    else
      $this->lineheight = XHTML2PDF_DEFLINESIZE;
      
    if ($this->currenttag[$this->depth] == 'a') {
    	//var_dump($this->attributes[$this->depth]['HREF']);
    	$this->Write($this->lineheight,$this->databuffer, $this->attributes[$this->depth]['HREF'],'','');
    }
    else {
    /*
    	if($this->currenttag[$this->depth] == 'sub') 
    		$this->Write($this->lineheight,$this->databuffer, '', $this->align, $this->cfg['SUB']=1);
    	elseif($this->currenttag[$this->depth] == 'sup') 
    		$this->Write($this->lineheight,$this->databuffer, '', $this->align, $this->cfg['SUP']=1);
    	else 
    */
    		$this->Write($this->lineheight,$this->databuffer, '', $this->align, '');
    }

    $this->databuffer = '';
    # Fin de l'affichage  
  }
  

  function begintag($parser, $name, $attrs)
  {
    //global $this->allowed; # config.php

    $this->name = strtolower($name); # tous les noms de classe st en lowercase
    $this->attrs = $attrs;
    
   
    $this->OutputBufferedData();
    $this->depth++;

    $this->currenttag[$this->depth] = $this->name;
    $this->attributes[$this->depth] = $this->attrs;
    
    foreach ($this->allowed as $tag => $value) {
      if ($value == 1)
        $this->SetClassAttrAsCurrent($this->name, $tag);
    }
    
    if (!empty($this->attrs['STYLE'])) {
      $this->inlinestyles = explode(';', $this->attrs['STYLE']);
      
      foreach ($this->inlinestyles as $inlinestyle) {
        $this->inlinestyle = trim($inlinestyle);
        
        if (strlen($this->inlinestyle) > 0){
          list($inlineattribute, $inlinevalue) = explode(':', $inlinestyle);
          $this->currentattr[$this->depth][$inlineattribute] = $inlinevalue;  
        }
      }
    }
    
    if ($this->name == 'br')
      $this->ln(XHTML2PDF_DEFLINESIZE); //
          
    if ($this->allowed['display']) {
      $this->SetClassAttrAsCurrent($this->currenttag[$this->depth], 'display', 0); # La propriété display ne s'hérite pas
      
      if ($this->currentattr[$this->depth]['display'] == 'block') {
      
        if ($this->readytodisplayablock == 0) {
          if (isset($this->currentattr[$this->depth-1]['font-size']))
            $this->ln($this->currentattr[$this->depth-1]['font-size']); //
        }
        
        if ($this->allowed['margin-top']) {
          if (isset($this->currentattr[$this->depth]['margin-top']))
            $this->ln(converttomm($this->currentattr[$this->depth]['margin-top']));//
        }
        
        if($this->allowed['margin-right']) {
        	$this->SetRightMargin($this->GetRightMargin()+converttomm($this->currentattr[$this->depth]['margin-right']));
        }
        
        if ($this->allowed['margin-left']) {
            $this->SetLeftMargin(converttomm($this->currentattr[$this->depth]['margin-left'])+$this->GetLeftMargin());//
        }    
           
      }      
          
    }  
    
      // Gestion des images !!!
      if( $this->name == 'img' && isset($this->attrs['SRC']) )  {
		
		$this->xplod = explode("/",$this->attrs['SRC']);
      	$this->revers = array_reverse($this->xplod);
      	$this->img_name = substr($this->revers[0], 0, -4);
      	$this->xplod2 = array_reverse(explode('.', $this->revers[0]));
      	$this->img_ext = $this->xplod2[0];
      	$this->ratio[0] = 72/25.4;
      	

      	if(substr($this->attrs['SRC'], 0, 7) == 'http://') $this->pic_name = $this->attrs['SRC'];
      	else $this->pic_name = X_RACINE.$this->attrs['SRC'];       
        
	    $this->a = GetImageSize($this->pic_name);
    	$this->SetY($this->GetY()+5);  
    
    	if (($this->GetX()+$this->a[0]/($this->ratio[0])) > ($this->GetPageWidth())) {
    	
    	  $this->ratio[1] = ($this->GetX()+$this->a[0]/($this->ratio[0]))/$this->GetPageWidth();
    	  
      	  $this->maxwidth = $this->GetPageWidth()*2.5;
	      $this->height = $this->a[1]/$this->ratio[1];
	      
    	  $this->img_dst = ImageCreateTrueColor($this->maxwidth,$this->height);
    	     	  	  
    	  if( strtolower($this->img_ext) == 'jpg' || strtolower($this->img_ext) == 'jpeg') 
    	  	$this->img_src = ImageCreateFromJpeg($this->pic_name);
    	  else $this->img_src = ImageCreateFromPng($this->pic_name);
    	  
    	  //if( strtolower($this->img_ext) == 'gif' )  $this->img_src = ImageCreateFromGif($this->pic_name);
    	  //if( strtolower($this->img_ext) == 'png' ) $this->img_src = ImageCreateFromPng($this->pic_name);
    	  //if( strtolower($this->img_ext) == 'xbm' ) $this->img_src = ImageCreateFromXbm($this->pic_name);
		  
    	  ImageCopyResized($this->img_dst,$this->img_src,0,0,0,0,$this->maxwidth,$this->height,ImageSX($this->img_src),ImageSY($this->img_src));
            	  
      	  if( strtolower($this->img_ext) == 'jpg' || strtolower($this->img_ext) == 'jpeg') {
      	  	$this->src_finished = md5(uniqid($this->img_name.rand())).'_tmp.jpg';
      	  	$this->finished = ImageJPEG($this->img_dst, X_PATH_SHARE_IMG.$this->src_finished);
      	  }
      	  else {
      	  	$this->src_finished = md5(uniqid($this->img_name.rand())).'_tmp.png';
      	  	$this->finished = ImagePNG($this->img_dst, X_PATH_SHARE_IMG.$this->src_finished);
      	  }
      	  
      	  //if( strtolower($this->img_ext) == 'gif' )  $this->finished = ImageGIF($this->img_dst, X_PATH_SHARE_IMG.$this->src_finished);      
      	  //if( strtolower($this->img_ext) == 'png' ) $this->finished = ImagePNG($this->img_dst, X_PATH_SHARE_IMG.$this->src_finished);
      	  //if( strtolower($this->img_ext) == 'xbm' ) $this->finished = ImageXBM($this->img_dst, X_PATH_SHARE_IMG.$this->src_finished);
  
    	  $this->pic_name = X_PATH_SHARE_IMG.$this->src_finished;
      
		     
		  if( strtolower($this->img_ext) == 'jpg' || strtolower($this->img_ext) == 'jpeg') 
		  	$this->finished = ImageJPEG($this->img_dst, $this->pic_name);
		  else $this->finished = ImagePNG($this->img_dst, $this->pic_name);
		  
		  //if( strtolower($this->img_ext) == 'gif' ) $this->finished = ImageGIF($this->img_dst, $this->pic_name);
		  //if( strtolower($this->img_ext) == 'png' ) $this->finished = ImagePNG($this->img_dst, $this->pic_name);  
		  //if( strtolower($this->img_ext) == 'xbm' ) $this->finished = ImageXBM($this->img_dst, $this->pic_name); 
		  
    	}
    	
		//} // else end !
		
	    $this->a = GetImageSize($this->pic_name);

    	if (($this->GetY()+$this->a[1]/($this->ratio[0])) > ($this->GetPageHeight()))
    	  $this->AddPage();
    
    	$this->Image($this->pic_name, ($this->GetPageWidth() - ($this->a[0]/($this->ratio[0])))/2, $this->GetY(), $this->a[0]/($this->ratio[0]),$this->a[1]/($this->ratio[0]));
    	$this->SetY($this->GetY()+$this->a[1]/($this->ratio[0])+5); 
		
		//ageDestroy($this->img_dst);
      }

  }

  function endtag($parser, $name)
  {
    //global $this->allowed; # config.php

    $this->name = strtolower($name);
    
    if(preg_match('`h[1-6]`',$this->name)) {
        $this->Bookmark($this->databuffer, $this->name[1]-1, -1);        //
    }

    if ($this->allowed['text-transform']) {
      if ($this->currentattr[$this->depth]['text-transform'] == 'uppercase')
        $this->databuffer = strtoupper($this->databuffer);
      else 
      if ($this->currentattr[$this->depth]['text-transform'] == 'lowercase')
        $this->databuffer = strtolower($this->databuffer);      
      else 
      if ($this->currentattr[$this->depth]['text-transform'] == 'capitalize')
        $this->databuffer = ucwords($this->databuffer);   
    }  
    
    #destruction des images
    if($this->name == 'img') $this->UnLinkImg($this->src_finished);
       
    $this->OutputBufferedData();

    # Rétablissement des paramètres
    if ($this->allowed['display'] && $this->currentattr[$this->depth]['display'] == 'block') {
      $this->ln($this->currentattr[$this->depth]['font-size']); # Conversion pt > mm //
      $this->readytodisplayablock = 1;
      
      if($this->allowed['margin-right']) {
      	$this->SetRightMargin($this->GetRightMargin()-converttomm($this->currentattr[$this->depth]['margin-right']));
      }      
      
      if ($this->allowed['margin-bottom']) {
        if (isset($this->currentattr[$this->depth]['margin-bottom']))
          $this->ln(converttomm($this->currentattr[$this->depth]['margin-bottom']));//
      }
      
      if ($this->allowed['margin-left']) {
        $this->SetLeftMargin($this->GetLeftMargin()-converttomm($this->currentattr[$this->depth]['margin-left']));
      }
          
    }

    $this->depth--;
  }

  # Fonction de rappel - on bufferise les données
  function handledata($parser, $data)
  { 
    if ($this->depth > 1 && $this->currenttag[1] == 'body' && $this->readytodisplayablock == 1 && trim($data) != '')
      $this->readytodisplayablock = 0;
      
    if ($this->depth > 1 && $this->currenttag[1] == 'body')
      $this->databuffer .= $data;
  }

  function xhtml2pdf($xhtml_file,$css_file,$config)
  { 
    parent::XFPDF();
      
    $this->currentattr = array();
    $this->depth = -1; # la première balise (html) aura la profondeur 0
    $this->readytodisplayablock = 1;
    
    $this->allowed = $config['allowed'];
    $this->attrdefault = $config['attrdefault'];
    $this->x_header =$config['choice']['header'];
    $this->x_footer = $config['choice']['footer'];
    $this->x_rect = $config['choice']['rectangle'];
    $this->licence = $config['choice']['licence'];
    $this->x_clr = $config['color'];
    $this->x_font = $config['font'];
    $this->x_web = $config['site'];
    $this->x_rights = $config['rights'];
    
	      
    if (file_exists($css_file))
      $this->content['css'] = file_get_contents($css_file);
    else
      return -1; 
      
    $this->css = new ccss;  
    $this->css->read($this->content['css']);
  
    //$this->SetFont($this->x_font['body']['family'],$this->x_font['body']['style'],$this->x_font['body']['size']);
    $this->AddPage();

  	$this->xml_parser = xml_parser_create();
    xml_set_object($this->xml_parser, $this);    
    xml_set_element_handler($this->xml_parser, "begintag", "endtag");    
    xml_set_character_data_handler($this->xml_parser, "handledata");

    $this->content['xhtml'] = file_get_contents($xhtml_file);
    
    // if charset = UTF8
    //if($this->x_web['charset'] == 'UTF-8') utf8_decode($this->content['xhtml']);
    
    // if have encoded html
    if(!empty($this->x_web['encoded_html'])) 
    	$this->content['xhtml'] = $this->unHTMLEntities($this->content['xhtml']);
    	
    xml_parse($this->xml_parser, $this->content['xhtml']);  
    xml_parser_free($this->xml_parser);
  }

  function ouput() {
  	$this->Output();
  }
  
// modified by Stephane HUC

   function Header() {
   	if(!empty($this->x_header)) {
      $this->SetX(0);
      
      if(!empty($this->x_rect)) {
      	$this->SetFillColor($this->x_clr['header']['rectangle']['R'], $this->x_clr['header']['rectangle']['G'], $this->x_clr['header']['rectangle']['B']);    
      	$this->Rect(0,0, $this->GetPageWidth(), $this->x_clr['header']['rectangle']['height'], $this->x_clr['header']['rectangle']['style']); 
      }
      
      $this->SetFont($this->x_font['header']['family'],$this->x_font['header']['style'],$this->x_font['header']['size']);
      $this->SetTextColor($this->x_clr['header']['text']['R'], $this->x_clr['header']['text']['G'], $this->x_clr['header']['text']['B']);
      $this->Cell(0,0,$this->PageNo() ,0,0,'R'); 
      $this->SetY($this->GetY()+5);
      $this->Line(10, $this->GetY(), 200, $this->GetY());
      $this->SetY($this->GetY()+14);
      
    }
   }
   
   function Footer() {
   	if(!empty($this->x_footer)) {
   	  if(!empty($this->x_rect)) {
   	  	$this->SetFillColor($this->x_clr['footer']['rectangle']['R'], $this->x_clr['footer']['rectangle']['G'], $this->x_clr['footer']['rectangle']['B']); 
      	$this->Rect(0, $this->GetPageHeight()-$this->x_clr['footer']['rectangle']['height'], $this->GetPageWidth(), $this->x_clr['footer']['rectangle']['height'], $this->x_clr['footer']['rectangle']['style']); 
      }
      $this->SetY(-15);
      $this->Line(10, $this->GetY(), 200, $this->GetY());
      $this->SetTextColor($this->x_clr['footer']['text']['R'], $this->x_clr['footer']['text']['G'], $this->x_clr['footer']['text']['B']); 
      $this->SetFont($this->x_font['footer']['family'],$this->x_font['footer']['style'],$this->x_font['footer']['size']);
      $this->SetX(10);
      
      if( $this->x_web['charset'] == 'UTF-8' ) {
      	$this->x_web['name'] = utf8_decode($this->x_web['name']);
      	$this->x_web['page'] = utf8_decode($this->x_web['page']);
      }
      
	  $this->Cell(0,10,$this->x_web['name'],0,0,'L',0,$this->x_web['url']['site']);
	  $this->Cell(0,10,$this->x_web['page'],0,0,'R',0,$this->x_web['url']['page']);
	 }
   }
   
   /***
    destroy image temp
    **/
   function UnLinkImg($img) {
   		if( file_exists(X_PATH_SHARE_IMG.$img) && is_file(X_PATH_SHARE_IMG.$img) ) unlink(X_PATH_SHARE_IMG.$img);
   }
   
   /***
    parse encode html
   ***/
   function unHTMLEntities($html) {
    		$this->tmp = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
    		
    		$this->table = array ( '&lt;', '&gt;', '&amp;',);
    		
    		$this->tmp = array_flip ($this->tmp);
    		
    		foreach($this->table as $val) {
    			if ( array_key_exists($val, $this->tmp) ) unset($this->tmp[$val]);
    		}
    		unset($val);
    		
    		$this->tmp['&#8217;'] = chr('39');
    		$this->tmp['&minus;'] = chr('45');
    		$this->tmp['&euro;'] = chr('128');
    		$this->tmp['&lsquor;'] = chr('130');
    		$this->tmp['&ldquor;'] = chr('132');
    		$this->tmp['&hellip;'] = chr('133');
    		$this->tmp['&dagger;'] = chr('134');
    		$this->tmp['&Dagger;'] = chr('135');
    		$this->tmp['&permil;'] = chr('137');
    		$this->tmp['&Scaron;'] = chr('138');
    		$this->tmp['&lsaquo;'] = chr('139');
    		$this->tmp['&OElig;'] = chr('140');
    		$this->tmp['&lsquo;'] = chr('145');
    		$this->tmp['&rsquo;'] = chr('146');
    		$this->tmp['&ldquo;'] = chr('147');
    		$this->tmp['&rdquo;'] = chr('148');
    		$this->tmp['&bull;'] = chr('149');
    		$this->tmp['&ndash;'] = chr('150');
    		$this->tmp['&endash;'] = chr('150');
    		$this->tmp['&mdash;'] = chr('151');
    		$this->tmp['&emdash;'] = chr('151');
    		$this->tmp['&tilde;'] = chr('152');
    		$this->tmp['&trade;'] = chr('153');
    		$this->tmp['&scaron;'] = chr('154');
    		$this->tmp['&rsaquo;'] = chr('155');
    		$this->tmp['&oelig;'] = chr('156');
    		$this->tmp['&Yuml;'] = chr('159');
    		
    		$this->html = strtr($html, $this->tmp);
    		
    		return($this->html);
    		//var_dump($this->tmp);
    		unset($this->tmp, $this->table);
    }
    
    /***
     recode url in href
    ***//*
    function recodeURL($str) {
    		//$str2 = preg_replace('/(<a href=")(.*)(".+>)(.*?)(<\/a>)/i', '<a href="'.urlencode('\\2').'_pouet">\\4</a>', $str);
    	//if(eregi('<a href="(.*)">(.*)</a>',$str,$href)) {
    	//if(eregi('href="(.*)"',$str,$href)) {
    	preg_match_all('!href="(.+)"!i', $str, $href);
    		//$url = parse_url($href[1]);
    		
    		$this->xploz = explode('"', $href[0][1]);
    		//var_dump($this->xploz);
    		$url = parse_url($this->xploz[1]);
    		
    		if( !empty($url['user']) && !empty($url['password']) ) $url['xhtml2pdf']['user_pass'] = $url['user'].':'.$url['password'].'@';
    		else $url['xhtml2pdf']['user_pass'] = '';
    		
    		$url['xhtml2pdf']['href'] = $url['scheme'].'://'.$url['xhtml2pdf']['user_pass'].$url['host'];
    		
    		if( !empty($url['path']) )	$url['xhtml2pdf']['href'] = $url['xhtml2pdf']['href'].$url['path'];
    		if( !empty($url['query']) )	$url['xhtml2pdf']['href'] = $url['xhtml2pdf']['href'].'?'.urlencode($url['query']);
    		if( !empty($url['fragment']) )		$url['xhtml2pdf']['href'] = $url['xhtml2pdf']['href'].'#'.$url['fragment'];
    		
    		
    		//var_dump($url);
    		
    		//$search = '<a href="(.*)">(.*)</a>';
    		//$replace = '<a href="'.$url['scheme'].'://'.$url['xhtml2pdf']['href'].'">'.$href[2].'</a>';
    		//$search = '<a href="(.*)">';
    		//$replace = '<a href="'.$url['scheme'].'://'.$url['xhtml2pdf']['href'].'">';
   			$search = '!href="(.+)"!isU'; 
   			$replace = 'href="'.$url['xhtml2pdf']['href'].'"';
   			
   		//$this->str = eregi_replace('<a href="(.*)">(.*)</a>', $replace, $str);
   		$this->str = preg_replace($search, $replace, $str);
    	return($this->str);
    	
    	unset($href, $url, $search, $replace);
    }
   */
   
   /***
   	display author's rights
   ***/
   function WriteRights() {
   	if(!empty($this->licence)) {
   	
   		$this->right = $this->x_rights['licence']['query'];
   	
   		if(!empty($this->x_rights['chapo']) && $this->right == 'LAL') $this->about = '[ '.strip_tags($this->x_rights['chapo']).' ]'."\n";
   		$this->about .= 'Copyright : '.$this->x_rights['author'].' - '.$this->x_rights['date']['created']."\n";
   		
   		if( in_array(strtoupper($this->right), $this->x_rights['licence']['code']) ) {
   			
   			$this->file_to_read = X_PATH_CLASS.'/licence/'.strtoupper($this->right).'_'.strtolower($this->x_web['lang']).'.txt';
   			
   			if( file_exists($this->file_to_read) && is_file($this->file_to_read) ) {
   				$this->file = file($this->file_to_read);
   			}
   			else { 
   				$this->file = file(X_PATH_CLASS.'/licence/'.strtoupper($this->right).'_en.txt');
   			}
   			
   			foreach($this->file as $val) {
   					$this->about .= $val;
   			}
   			unset($val, $this->file_to_read);
   		
   			if(!empty($this->x_rights['licence']['url'][$this->right])) $this->about .= $this->x_rights['licence']['url'][$this->right];
   		}
   		
   		$this->AddPage();
   		$this->SetFont('Courier','',12);
 		$this->MultiCell(0, 6, $this->about, '', 'L');
 		
	}
   }
}

?>
