<?php
session_start();
if(!isset($con))
{
	include("configlocale.php");
	include("{$dirsito}config.php");
	include("{$dirsito}libreria/util_dbnew.php");
	include("{$dirsito}libreria/util_func2.php");
	$con = connessione(HOST,USER,PWD,DBNAME);
}


if(!isset($_POST["nomecamposelecttabparent"]) || intval($_POST["nomecamposelecttabparent"]) <= 0)
{
	
	echo "0" ;
	
	exit;
}

$postval = intval($_POST["nomecamposelecttabparent"]);	
$sql = "select * from {$tabparent} where {$campiid["tabparent"]} = {$postval}";
$rs = esegui_query($con,$sql);
$r = getrecord($rs);
$stringa = $campiparent[2] . "=" . html_entity_decode($r[$campiparent[2]],ENT_QUOTES) . "|" . $campiparent[3] . "=" . html_entity_decode($r[$campiparent[3]],ENT_QUOTES) . "|" . $campiparent[4] . "=" . html_entity_decode($r[$campiparent[4]],ENT_QUOTES) . "|" . $campiparent[5] . "=" . html_entity_decode($r[$campiparent[5]],ENT_QUOTES);
echo $stringa;
?>
