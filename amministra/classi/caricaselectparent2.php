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



		
function optsel2($con,$val,$tabella,$ordine,$campoidesterno,$campiparent)
{
	$sql = "select * from {$tabella} order by {$ordine}";
	$rs = esegui_query($con,$sql);
	
	$elenco = "<option value=\"0\">Seleziona da elenco</option>";
	while($r = getrecord($rs))
	{
		if($r[$campoidesterno] == $val)
			$elenco .= "<option value=\"{$r[$campiparent[0]]}\" selected=\"selected\">{$r[$campiparent[1]]} {$r[$campiparent[2]]}</option>";
		else
			$elenco .= "<option value=\"{$r[$campiparent[0]]}\">{$r[$campiparent[1]]} {$r[$campiparent[2]]}</option>";
	}
	return $elenco;
}

$valselect = intval($_POST["idparent"]);
$colonna5 = optsel2($con,$valselect,$tabparent2,$ordine["tabparent2"],$campiid["tabparent2"],$campiparent2);
$stringa = "<select class=\"form-control\" id=\"e0\">{$colonna5}</select>";
echo $stringa;
?>

