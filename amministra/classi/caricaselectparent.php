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



		
function optsel($con,$val,$tabella,$ordine,$campiid,$campiparent)
{
	$sql = "select * from {$tabella} order by {$ordine}";
	$rs = esegui_query($con,$sql);
	
	$elenco = "<option value=\"0\">Seleziona da elenco</option>";
	while($r = getrecord($rs))
	{
		if($r[$campiid["tabparent"]] == $val)
			$elenco .= "<option value=\"{$r[$campiparent[0]]}\" selected=\"selected\">{$r[$campiparent[1]]}</option>";
		else
			$elenco .= "<option value=\"{$r[$campiparent[0]]}\">{$r[$campiparent[1]]}</option>";
	}
	return $elenco;
}

$valselect = intval($_POST["idparent"]);
$colonna2 = optsel($con,$valselect,$tabparent,$ordine["tabparent"],$campiid,$campiparent);
$stringa = "<select class=\"form-control\" id=\"b0\">{$colonna2}</select>";
echo $stringa;
?>

