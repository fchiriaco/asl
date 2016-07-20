<?
function creastilelayerabsleft($top=0,$inctop=0,$left=5,$backcolor="",$backimg="",$color="",$fontweight="",$border="",$height="",$fontsize=0.75,$allinea="left",$zindex=1,$width="25%",$interlinea="1.5em",$padding=2)
{
	$newtop = $top + $inctop;
	$stringa = "\"position:absolute;top:{$newtop}px;left:{$left}px;";
	if ($backcolor != "")
		$stringa .= "background-color:$backcolor;";
	
	if ($backimg != "")
		$stringa .= "background-image:url('$backimg');";
	if ($color != "")
		$stringa .= "color:$color;";
	if ($border != "")
		$stringa .= $border;
	$stringa .= "margin-left:0px;";
	$stringa .= "padding:{$padding}px;";
	$stringa .= "font-size:{$fontsize}em;";
	if ($fontweight != "" )
		$stringa .= "font-weight:$fontweight;";
	$stringa .=  "line-height:$interlinea;";
	$stringa .= "text-align:$allinea;";
	$stringa .= "z-index:$zindex;";
	$stringa .= "width:$width;";
	if($height != "")
		$stringa .= "height:{$height}px;";
	$stringa .= "overflow:auto;";
	$stringa .= "\"";
	echo $stringa;
}



function creastilelayerabsright($top=0,$inctop=0,$right=5,$backcolor="",$backimg="",$color="",$fontweight="",$border="",$height="",$fontsize=0.75,$allinea="left",$zindex=1,$width="25%",$interlinea="1.5em",$padding=2)
{
	$newtop = $top + $inctop;
	$stringa = "\"position:absolute;top:{$newtop}px;right:{$right}px;";
	if ($backcolor != "")
		$stringa .= "background-color:$backcolor;";
	
	if ($backimg != "")
		$stringa .= "background-image:url('$backimg');";
	if ($color != "")
		$stringa .= "color:$color;";
	if ($border != "")
		$stringa .= $border;
	$stringa .= "margin-right:0px;";
	$stringa .= "padding:{$padding}px;";
	$stringa .= "font-size:{$fontsize}em;";
	$stringa .= "text-align:$allinea;";
	if ($fontweight != "" )
		$stringa .= "font-weight:$fontweight;";
	$stringa .=  "line-height:$interlinea;";
	$stringa .= "z-index:$zindex;";
	$stringa .= "width:$width;";
	if($height != "")
		$stringa .= "height:{$height}px;";
	$stringa .= "overflow:auto;";
	$stringa .= "\"";
	echo $stringa;
}

?>