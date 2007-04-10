<?php
//  define('FPDF_FONTPATH', SH_PATH_TOOLS.'/classes/font/');
  include_once('fpdf.php');
  
  class XFPDF extends FPDF {
    var $outlines=array();
    var $OutlineRoot;
    var $linethrough;		//line-through flag (add by Stephane HUC)
    var $cfg;
    var $SUB;
    var $SUP;
    
    function XFPDF ($orientation='P',$unit='mm',$format='A4') {
    
    	parent::FPDF($orientation, $unit, $format);
    	$this->linethrough = false; // add by Stephane HUC
    	//$this->SUB = 0; $this->SUP = 0;
    }
    
/*******************************************************************************
*                                                                             
*                                                    Public methods                                
*                                                                             
*******************************************************************************/
   
    function SetFont($family,$style='',$size=0) {
		//Select a font; size given in points
		global $fpdf_charwidths;

		$family=strtolower($family);
		if($family=='') $family=$this->FontFamily;
		if($family=='arial') $family='helvetica';
		elseif($family=='symbol' || $family=='zapfdingbats') $style='';
	
		$style=strtoupper($style);
	
		if(strpos($style,'U')!==false) {
			$this->underline=true;
			$style=str_replace('U','',$style);
		}
		else $this->underline=false;
	
		if(strpos($style,'LT')!==false) { // add by Stephane HUC
			$this->linethrough=true;
			$style=str_replace('LT','',$style);
		}
		else $this->linethrough=false;
	
		if($style=='IB') $style='BI';
		if($size==0) $size=$this->FontSizePt;
	
		//Test if font is already selected
		if($this->FontFamily==$family && $this->FontStyle==$style && $this->FontSizePt==$size)
			return;
	
		//Test if used for the first time
		$fontkey=$family.$style;
		if(!isset($this->fonts[$fontkey])) {
			//Check if one of the standard fonts
			if(isset($this->CoreFonts[$fontkey])) {
				if(!isset($fpdf_charwidths[$fontkey])) {
					//Load metric file
					$file=$family;
					if($family=='times' || $family=='helvetica') $file.=strtolower($style);
				
					include($this->_getfontpath().$file.'.php');
				
					if(!isset($fpdf_charwidths[$fontkey])) $this->Error('Could not include font metric file');
				}
				$i=count($this->fonts)+1;
				$this->fonts[$fontkey]=array('i'=>$i,'type'=>'core','name'=>$this->CoreFonts[$fontkey],'up'=>-100,'ut'=>50,'cw'=>$fpdf_charwidths[$fontkey]);
			}
			else $this->Error('Undefined font: '.$family.' '.$style);
		}
		//Select it
		$this->FontFamily=$family;
		$this->FontStyle=$style;
		$this->FontSizePt=$size;
		$this->FontSize=$size/$this->k;
		$this->CurrentFont=&$this->fonts[$fontkey];
		if($this->page>0)
			$this->_out(sprintf('BT /F%d %.2f Tf ET',$this->CurrentFont['i'],$this->FontSizePt));
	}

/***
 Addpage
***/	
	function AddPage($orientation='') {
    	//Start a new page
		if($this->state==0) $this->Open();
		$family=$this->FontFamily;
		/*** modified by Stephane HUC ***/
		//$style=$this->FontStyle.($this->underline ? 'U' : '');
		$style=$this->FontStyle.($this->underline ? 'U' : '').($this->linethrough ? 'LT' : '');
		/*** end ***/
		$size=$this->FontSizePt;
		$lw=$this->LineWidth;
		$dc=$this->DrawColor;
		$fc=$this->FillColor;
		$tc=$this->TextColor;
		$cf=$this->ColorFlag;
		
		if($this->page>0) 	{
			//Page footer
			$this->InFooter=true;
			$this->Footer();
			$this->InFooter=false;
			//Close page
			$this->_endpage();
		}
		
 		//Start new page
		$this->_beginpage($orientation);
		//Set line cap style to square
		$this->_out('2 J');
		//Set line width
		$this->LineWidth=$lw;
		$this->_out(sprintf('%.2f w',$lw*$this->k));
		//Set font
		if($family) 	$this->SetFont($family,$style,$size);
		//Set colors
		$this->DrawColor=$dc;
		if($dc!='0 G') $this->_out($dc);
		$this->FillColor=$fc;
		if($fc!='0 g') $this->_out($fc);
		$this->TextColor=$tc;
		$this->ColorFlag=$cf;
		//Page header
		$this->Header();
		
		//Restore line width
		if($this->LineWidth!=$lw) {
			$this->LineWidth=$lw;
			$this->_out(sprintf('%.2f w',$lw*$this->k));
		}
		
		//Restore font
		if($family) $this->SetFont($family,$style,$size);
		
		//Restore colors
		if($this->DrawColor!=$dc) {
			$this->DrawColor=$dc;
			$this->_out($dc);
		}
		
		if($this->FillColor!=$fc) {
			$this->FillColor=$fc;
			$this->_out($fc);
		}
		
		$this->TextColor=$tc;
		$this->ColorFlag=$cf;
    }

/***
 Manage Cell
***/
	function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align,$fill=0,$link='') {
		
		//Output a cell
		$k=$this->k;
		if($this->y+$h>$this->PageBreakTrigger && !$this->InFooter && $this->AcceptPageBreak()) {
			//Automatic page break
			$x=$this->x;	//Current X position
			$ws=$this->ws;	//Word Spacing
			
			if($ws>0) {
				$this->ws=0;
				$this->_out('0 Tw');
			}
			
			$this->AddPage($this->CurOrientation);
			$this->x=$x;
			
			if($ws>0) {
			$this->ws=$ws;
			$this->_out(sprintf('%.3f Tw',$ws*$k));
			}
		}
		
		if($w==0) $w=$this->w-$this->rMargin-$this->x;
		$s='';
		
		if($fill==1 || $border==1) 	{
			if($fill==1) $op=($border==1) ? 'B' : 'f';
			else $op='S';
			$s=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
		}
		
		if(is_string($border)) {
			$x=$this->x;
			$y=$this->y;
			if(strpos($border,'L')!==false)
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
			if(strpos($border,'T')!==false)
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
			if(strpos($border,'R')!==false)
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
			if(strpos($border,'B')!==false)
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
		}
		if($txt!=='') {

			if($align=='R') $dx=$w-$this->cMargin-$this->GetStringWidth($txt);
			elseif($align=='C') $dx=($w-$this->GetStringWidth($txt))/2;
			elseif ($align=='L' || $align=='J') $dx=$this->cMargin;
			else $dx=0;
			//var_dump($cfg);
			/*
			if(!empty($cfg)) { 
				if(!empty($cfg['SUB'])) $this->SUB = $cfg['SUB'];
				if(!empty($cfg['SUP'])) $this->SUB = $cfg['SUP'];
			}
*/
			if($this->ColorFlag) $s.='q '.$this->TextColor.' ';
			
			$txt2=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
			
			if(!empty($this->SUB)) 
				$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*($h+1)+.3*$this->FontSize))*$k,$txt2);
			elseif(!empty($this->SUP)) 
				$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*($h-1)+.3*$this->FontSize))*$k,$txt2);
			else
				$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$txt2);
		
			if($this->underline)
				$s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
			if($this->linethrough) // add by Stephane HUC
				$s.=' '.$this->_dounderline($this->x+$dx,$this->y+.1*$h+.3*$this->FontSize,$txt);

				
			if($this->ColorFlag) $s.=' Q';
			if($link)
				$this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$this->GetStringWidth($txt),$this->FontSize,$link);
		}
		
		if($s) $this->_out($s);
		$this->lasth=$h;
		
		if($ln>0) {
			//Go to next line
			$this->y+=$h;
			if($ln==1) 	$this->x=$this->lMargin;
		}
		else $this->x+=$w;
	}

/***
  Manage Image
***/   
	function Image($file,$x,$y,$w=0,$h=0,$type='',$link='') {
	/*
 		// add this code

		// work out if the image is a gif
		// if so, make it a png
		$this->tmp['img'] = getImageSize($file);
	
		if ($this->tmp['img'][2] == '1') {
			$this->tmp['filename'] = tempnam('/tmp/', 'gif4fpdf'.md5(uniqid(rand())) );
			$this->img['tmp'] = imagecreatefromgif($file);
			imagepng($this->img['tmp'], $this->tmp['filename']);
			rename($this->tmp['filename'], $this->tmp['filename'].'.png');
			$file = $this->tmp['filename'].'.png';
		}
		unset($this->tmp, $this->img);

		// end added code

		parent::Image($file,$x,$y,$w,$h,$type,$link);
	*/
		//Put an image on the page
		if(!isset($this->images[$file])) {
			//First use of image, get info
			if($type=='') 	{
				$pos=strrpos($file,'.');
	
				if(!$pos)
					$this->Error('Image file has no extension and no type was specified: '.$file);
	
				$type=substr($file,$pos+1);
			}
	
			$type=strtolower($type);
			$mqr=get_magic_quotes_runtime();
			set_magic_quotes_runtime(0);
		
			if($type=='jpg' or $type=='jpeg') $info=$this->_parsejpg($file);
			elseif($type=='png') $info=$this->_parsepng($file);
			elseif($type=='gif') $info=$this->_parsegif($file);
			else $this->Error('Unsupported image file type: '.$type);
	
			set_magic_quotes_runtime($mqr);
			$info['i']=count($this->images)+1;
			$this->images[$file]=$info;
		}
		else $info=$this->images[$file];

		//Automatic width or height calculation
		if($w==0) $w=$h*$info['w']/$info['h'];
		if($h==0) $h=$w*$info['h']/$info['w'];
	
		$this->_out(sprintf('q %.2f 0 0 %.2f %.2f %.2f cm /I%d Do Q',$w*$this->k,$h*$this->k,$x*$this->k,($this->h-($y+$h))*$this->k,$info['i']));
		
		if($link)	$this->Link($x,$y,$w,$h,$link);

	}

/***
 Manage Text
***/
	function Text($x,$y,$txt) {
		//Output a string
		$s=sprintf('BT %.2f %.2f Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
		if($this->underline && $txt!='') $s.=' '.$this->_dounderline($x,$y,$txt);
		if($this->linethrough && $txt!='') $s.=' '.$this->_dounderline($x,$y,$txt);  // add by Stephane HUC
		if($this->ColorFlag) $s='q '.$this->TextColor.' '.$s.' Q';
		$this->_out($s);
	}
	
/***
 Manage Write
***/	
	function Write($h,$txt,$link='',$align) {
	
     	//Output text in flowing mode
      $cw=&$this->CurrentFont['cw'];
      $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r",'',$txt);
      $nb=strlen($s);
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $ns=0;
      $nl=1;
      while($i<$nb)
      {
        //Get next character
        $c=$s{$i};
        if($c=="\n")
        {
          //Explicit line break
          $this->Cell($w,$h,substr($s,$j,$i-$j),0,2,$align,0,$link);
          $i++;
          $sep=-1;
          $j=$i;
          $l=0;
          $ns=0;
          if($nl==1)
          {
            $this->x=$this->lMargin;
            $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
          }
          $nl++;
          continue;
        }
        if($c==' ') {
          $sep=$i;
          $ls=$l;
          $ns++;
        }
        $l+=$cw[$c];
        if($l>$wmax)
        {
          //Automatic line break
          if($sep==-1)
          {
            if($this->x>$this->lMargin)
            {
              //Move to next line
              $this->x=$this->lMargin;
              $this->y+=$h;
              $w=$this->w-$this->rMargin-$this->x;
              $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
              $i++;
              $nl++;
              continue;
            }
            if($i==$j)
              $i++;
            $this->Cell($w,$h,substr($s,$j,$i-$j),0,2,$align,0,$link);
          }
          else
          {
          	 if($align=='J') {
					$this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
					$this->_out(sprintf('%.3f Tw',$this->ws*$this->k));
				}
            $this->Cell($w,$h,substr($s,$j,$sep-$j),0,2,$align,0,$link);
            $i=$sep+1;
          }
          $sep=-1;
          $j=$i;
          $l=0;
          $ns=0;
          if($nl==1)
          {
            $this->x=$this->lMargin;
            $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
          }
          $nl++;
        }
        else
          $i++;
      }
      //Last chunk
      if($i!=$j)
        $this->Cell($l/1000*$this->FontSize,$h,substr($s,$j),0,0,$align,0,$link);
    }
/*** PUBLIC METHODS ADD IN FPDF ***/

	function GetPageWidth()	{ return $this->w; }
	function GetPageHeight()	{ return $this->h; }
	function GetLeftMargin()	{ return $this->lMargin; }
	function GetTopMargin()	{ return $this->tMargin; }
	function GetRightMargin() { return $this->rMargin; }
/***
 Manage Bookmark
***/	
    function Bookmark($txt,$level=0,$y=0)
    {
        if($y==-1)
            $y=$this->GetY();
        $this->outlines[]=array('t'=>$txt,'l'=>$level,'y'=>$y,'p'=>$this->PageNo());
    }

/***
 Manage Table HTML 
***/
	function WriteTable($data,$w) {
    	$this->SetLineWidth(.3);
	    $this->SetFillColor(255,255,255);
    	$this->SetTextColor(0);
    	$this->SetFont('');
    	
    	foreach($data as $row) {
	        $nb=0;
    	    for($i=0;$i<count($row);$i++)
	            $nb=max($nb,$this->NbLines($w[$i],trim($row[$i])));
    
    	    $h=5*$nb;
    	    $this->CheckPageBreak($h);
    	    
    	    for($i=0;$i<count($row);$i++) {
	            $x=$this->GetX();
    	        $y=$this->GetY();
    	        $this->Rect($x,$y,$w[$i],$h);
    	        $this->MultiCell($w[$i],5,trim($row[$i]),0,'C');
    	        //Put the position to the right of the cell
    	        $this->SetXY($x+$w[$i],$y);                    
    	    }
    	    $this->Ln($h);
    	}
	}
	
	function CheckPageBreak($h) {
	    //If the height h would cause an overflow, add a new page immediately
    	if($this->GetY()+$h>$this->PageBreakTrigger)
    	    $this->AddPage($this->CurOrientation);
	}
	
	function ParseTable($Table) {
	    $this->_var='';
    	$this->table = $Table;
    
    	$parser = new HtmlParser ($this->table);
    
    	while ($parser->parse()) {
    	    if(strtolower($parser->iNodeName)=='table') {
	            if($parser->iNodeType == NODE_TYPE_ENDELEMENT) $this->_var .='/::';
	            else $this->_var .='::';
	        }

    	    if(strtolower($parser->iNodeName)=='tr') {
	            if($parser->iNodeType == NODE_TYPE_ENDELEMENT) $this->_var .='!-:'; //opening row
	            else $this->_var .=':-!'; //closing row
	        }
	        
	        if(strtolower($parser->iNodeName)=='td' && $parser->iNodeType == NODE_TYPE_ENDELEMENT)
	            $this->_var .='#,#';
    		
    		if ($parser->iNodeName=='Text' && isset($parser->iNodeValue))
    			$this->_var .= $parser->iNodeValue;
     
    	}
    	
	    $this->elems = split(':-!',str_replace('/','',str_replace('::','',str_replace('!-:','',$this->_var)))); //opening row
    	
    	foreach($this->elems as $key=>$value) {
	        if(trim($value)!='') {
	            $this->elems2 = split('#,#',$value);
    	        array_pop($this->elems2);
    	        $this->data[] = $this->elems2;
    	    }
    	}
    	
    	return $this->data;
	}

/*******************************************************************************
*                                                                              
*                                                   Protected methods                             
*                                                                             
*******************************************************************************/
     
     function _parsegif($file) { //GIF support is now included - Function by Jérôme Fenal
		require_once(X_PATH_CLASS.'/gif.php'); //GIF class in pure PHP from Yamasoft (http://www.yamasoft.com/php-gif.zip)

		$h=0;
		$w=0;
		$gif=new CGIF();

		if (!$gif->loadFile($file, 0)) $this->Error("GIF parser: unable to open file $file");

		if($gif->m_img->m_gih->m_bLocalClr) {
			$nColors = $gif->m_img->m_gih->m_nTableSize;
			$pal = $gif->m_img->m_gih->m_colorTable->toString();
	
			if($bgColor != -1) {
				$bgColor = $this->m_img->m_gih->m_colorTable->colorIndex($bgColor);
			}
	
			$colspace='Indexed';
	
		} elseif($gif->m_gfh->m_bGlobalClr) {
			$nColors = $gif->m_gfh->m_nTableSize;
			$pal = $gif->m_gfh->m_colorTable->toString();
	
			if((isset($bgColor)) and $bgColor != -1) {
				$bgColor = $gif->m_gfh->m_colorTable->colorIndex($bgColor);
			}
	
			$colspace='Indexed';
	
		} else {
			$nColors = 0;
			$bgColor = -1;
			$colspace='DeviceGray';
			$pal='';
		}

		$trns='';
		if($gif->m_img->m_bTrans && ($nColors > 0)) {
			$trns=array($gif->m_img->m_nTrans);
		}

		$data=$gif->m_img->m_data;
		$w=$gif->m_gfh->m_nWidth;
		$h=$gif->m_gfh->m_nHeight;

		if($colspace=='Indexed' and empty($pal)) $this->Error('Missing palette in '.$file);

		if ($this->compress) {
			$data=gzcompress($data);
			return array( 'w'=>$w, 'h'=>$h, 'cs'=>$colspace, 'bpc'=>8, 'f'=>'FlateDecode', 'pal'=>$pal, 'trns'=>$trns, 'data'=>$data);
		} else {
			return array( 'w'=>$w, 'h'=>$h, 'cs'=>$colspace, 'bpc'=>8, 'pal'=>$pal, 'trns'=>$trns, 'data'=>$data);
		} 
	} 
	
    function _putbookmarks()
    {
        $nb=count($this->outlines);
        if($nb==0)
            return;
        $lru=array();
        $level=0;
        foreach($this->outlines as $i=>$o)
        {
            if($o['l']>0)
            {
                $parent=$lru[$o['l']-1];
                //Set parent and last pointers
                $this->outlines[$i]['parent']=$parent;
                $this->outlines[$parent]['last']=$i;
                if($o['l']>$level)
                {
                    //Level increasing: set first pointer
                    $this->outlines[$parent]['first']=$i;
                }
            }
            else
                $this->outlines[$i]['parent']=$nb;
            if($o['l']<=$level and $i>0)
            {
                //Set prev and next pointers
                $prev=$lru[$o['l']];
                $this->outlines[$prev]['next']=$i;
                $this->outlines[$i]['prev']=$prev;
            }
            $lru[$o['l']]=$i;
            $level=$o['l'];
        }
        //Outline items
        $n=$this->n+1;
        foreach($this->outlines as $i=>$o)
        {
            $this->_newobj();
            $this->_out('<</Title '.$this->_textstring($o['t']));
            $this->_out('/Parent '.($n+$o['parent']).' 0 R');
            if(isset($o['prev']))
                $this->_out('/Prev '.($n+$o['prev']).' 0 R');
            if(isset($o['next']))
                $this->_out('/Next '.($n+$o['next']).' 0 R');
            if(isset($o['first']))
                $this->_out('/First '.($n+$o['first']).' 0 R');
            if(isset($o['last']))
                $this->_out('/Last '.($n+$o['last']).' 0 R');
            $this->_out(sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]',1+2*$o['p'],($this->h-$o['y'])*$this->k));
            $this->_out('/Count 0>>');
            $this->_out('endobj');
        }
        //Outline root
        $this->_newobj();
        $this->OutlineRoot=$this->n;
        $this->_out('<</Type /Outlines /First '.$n.' 0 R');
        $this->_out('/Last '.($n+$lru[0]).' 0 R>>');
        $this->_out('endobj');
    }
    
	function _putcatalog()
    {
        parent::_putcatalog();
        if(count($this->outlines)>0)
        {
            $this->_out('/Outlines '.$this->OutlineRoot.' 0 R');
            $this->_out('/PageMode /UseOutlines');
        }
    }
   
	function _putresources()
    {
         parent::_putresources();
        $this->_putbookmarks();
    }
      }

?>
