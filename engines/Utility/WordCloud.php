<?php
/**
 * Wordcloud Generator
 * @author Hapsoro Renaldy <dufronte at gmail.com>
 */
class Wordcloud{
	var $str = "";
	var $width = 470;
	var $height = 370;
	var $step = 2;
	var $deg = 0;
	var $radius = 0;
	var $centerX = 0;
	var $centerY = 0;
	var $max_font_height = 44;
	var $style="wcstat1";
	var $dimension = array();
	function __construct($width=470,$height=370,$step=2,$radius=0){
		$this->width = $width;
		$this->height= $height;
		$this->step = $step;
		$this->radius = $radius;
		
		$this->centerX = $this->width/2;
		$this->centerY= $this->height/2;
		
		$this->dimension = array(array("width"=>10,"height"=>10),
		array("width"=>8,"height"=>14),
		array("width"=>10,"height"=>22),
		array("width"=>14,"height"=>28),
		array("width"=>16,"height"=>30),
		array("width"=>18,"height"=>34),
		array("width"=>18,"height"=>40),
		array("width"=>18,"height"=>44),
		array("width"=>18,"height"=>50),
		array("width"=>20,"height"=>54));
		
	}
	function sinAns($val) {
		$ans = sin(deg2rad($val));
		return $ans;
	}

	function cosAns($val) {
		$ans = cos(deg2rad($val));
		return $ans;
	}

	function tanAns($val) {
		if ($val > 90 || $val <= 0) {
			return 0;
		} else {
			$ans = tan(deg2rad($val));
			return $ans;
		}
	}
	function deg2x($deg,$radius){
		$x = $radius * cosAns($deg);
		return $x;
	}
	function deg2y($deg,$radius){
		$y = $radius * sinAns($deg);
		return $y;
	}
	function toXY($deg,$radius){
		$arr = array("x"=>deg2x($deg,$radius),"y"=>deg2y($deg,$radius));
		return $arr;
	}

	function overlap($x,$y,$top,$bottom,$left,$right,$txt,$steps){
		$n_placed=0;
		foreach($txt as $tt){
			$a_offsetLeft = $left;
			$a_offsetTop = $top;
			$a_offsetWidth = round($right - $left)*0.95;
			$a_offsetHeight = round($bottom-$top)*0.8;
			$b_offsetLeft = $tt['left'];
			$b_offsetTop = $tt['top'];
			$b_offsetWidth = round($tt['right'] - $tt['left'])*0.95;
			$b_offsetHeight = round($tt['bottom']-$tt['top'])*0.8;
			if(abs(2*$a_offsetLeft+$a_offsetWidth-2*$b_offsetLeft-$b_offsetWidth) < $a_offsetWidth + $b_offsetWidth){
				if (abs(2*$a_offsetTop + $_offsetHeight - 2*$b_offsetTop - $b_offsetHeight) < $a_offsetHeight + $b_offsetHeight) {
					return true;
				}
			}
			$n_placed++;
			//print "#".$n_placed."<br/>";
			if($n_placed==$steps){return false;}
			 
		}
		return false;
	}
	function setDimension($idx,$width,$height){
		
	}
	function draw($txt){
		//$str = "<div style='width:".$this->width."px;height:".$this->height.";position:absolute;overflow:hidden'>";
		$str="";
		if(is_array($txt)){
			$total = sizeof($txt);
			$n=0;
			$retry=0;
			$step = 0.1;
			$deg = 30;
			$index = 0;
			$radius = $this->radius;
			$width  =$this->width;
			$height = $this->height;
			$x = $this->centerX;
			$y = $this->centerY;
			$deg = $this->deg;
			$weights = array();
			foreach($txt as $nn=>$v){
				if($weights[$txt[$nn]['weight']]==null){		
					$weights[$txt[$nn]['weight']] = 0;
				}
				$weights[$txt[$nn]['weight']]+=1;
			}
			$n_range = sizeof($weights);
			
			while($n<$total){
				
				$retry=0;
				$txt[$n]['size'] = ceil($txt[$n]['weight']/10*$n_range);
				//if($n==0){
				//	$txt[$n]['size'] = 9;
				//}else{
				//	$txt[$n]['size'] = 6;
				//}
				
				//$txt[$n]['txt'] = $n."#".$txt[$n]['txt'];
				$deg = 0.62*rand(0,100);
				$iter=0;
				$radius = 0.1;
				if($n>0&&$n%2==0){
					$ori = 1;
				}else{
					$ori = -1;
				}
				do{
					//$deg = rand(-360,360);
					//$deg = 0.62*rand(0,100)*$ori;
					$deg = 0.62*rand(0,360) * $ori;
					$radius+=1;
					$dim = $this->dimension[$txt[$n]['size']];
					//$alignX = ($txt[$n]['weight']*(($dim['width'])*strlen($txt[$n]['txt']))/10)/2;
					$txt_width = $dim['width']*strlen($txt[$n]['txt']);
					$txt_height = $dim['height'];
					$alignX = $dim['width']*strlen($txt[$n]['txt'])/2;
					//$alignY = ($txt[$n]['weight']*$this->max_font_height/10)/2;
					$alignY = $dim['height']/2;
					$xx = $x + ($radius * $this->cosAns($deg))/2;
					$yy = $y + ($radius * $this->sinAns($deg))/2;
					
					
					$xx-=$alignX;
					$yy-=$alignY;
					
					//$txt_top = $yy-(($alignY));
					//$txt_bottom = $yy+(($alignY));
					//$txt_left = $xx-(($alignX));
					//$txt_right = $xx+(($alignX));
					$txt_top = $yy;
					$txt_left = $xx;
					$txt_right = $xx+($txt_width*0.95);
					$txt_bottom = $yy+($txt_height);
					$retry++;
					if($retry==100000){
						//print "too many loops !";
						//die();
						break;
					}
					$iter++;
				}while($this->overlap($xx,$yy,$txt_top,$txt_bottom,$txt_left,$txt_right,$txt,$n));
				
				
				$txt[$n]['x'] = $xx;
				$txt[$n]['y'] = $yy;
				$txt[$n]['top'] = $txt_top;
				$txt[$n]['left'] = $txt_left;
				$txt[$n]['bottom'] = $txt_bottom;
				$txt[$n]['right'] = $txt_right;
				$txt[$n]['width'] = $txt_width;
				$txt[$n]['height'] = $txt_height;
				
				$n++;
			}
			
			//$n=0;
			
			
			for($i=sizeof($txt)-1;$i>=0;$i--){
				$t = $txt[$i];
				//$t['size'] = ceil($t['weight']/10*$n_range);
				
				$str.=$this->writeHTML($t,$n);
				$n++;
			}
			
		}
		//$str .= "</div>";
		return $str;
	}
	function writeHTML($t,$n){
		$str = "<span id='wc".$n."' class='wc".$t['size']."' style='top:".$t['y']."px;left:".$t['x']."px;position:absolute;overflow:hidden;float:left;width:".$t['width']."px;height:".$t['height']."px;'><a href='#' class='".$this->style."' style='float:left;text-decoration:none;font-family:verdana;'>".$t['txt']."</a></span>";
		return $str;
	}
}
?>