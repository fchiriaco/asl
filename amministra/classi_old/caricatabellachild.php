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






$strtabella = "<table class=\"table table-responsive\" id=\"tchild\"><thead>";
$strtabella .= "<tr><th>{$campichilddesc[1]}</th><th>{$campiparentdesc[1]}</th><th>{$campichilddesc[2]}</th><th>{$campichilddesc[3]}</th>";
	if(isset($_SESSION["aut"]) &&($_SESSION["aut"] == 1) && isset($_SESSION["area"]) && (strpos($_SESSION["area"],$areaaut) !== false ) && isset($_SESSION["amministratore"][$areaaut]) && ($_SESSION["amministratore"][$areaaut] == 1)) 
	{
		 $strtabella .= "<th style=\"text-align:center;\">MODIFICA</th>";
		 $strtabella .= "<th style=\"text-align:center;\">ELIMINA</th>";
	}
	$strtabella .= "</tr></thead><tbody>";
	
	if(isset($_POST["nomecamposelecttabparent"]) && intval($_POST["nomecamposelecttabparent"]) > 0)
		$sql = "select {$tabchild}.{$campiid["tabchild"]} as idchild,{$tabchild}.*,{$tabparent}.* from {$tabchild},{$tabparent} where {$tabchild}.{$campo_chiave_esterna_child} = {$tabparent}.{$campiid["tabparent"]} and {$campo_chiave_esterna_child} = {$_POST["nomecamposelecttabparent"]} order by {$ordine["tabchild"]}";
	else
		$sql = "select {$tabchild}.{$campiid["tabchild"]} as idchild,{$tabchild}.*,{$tabparent}.* from {$tabchild},{$tabparent} where {$tabchild}.{$campo_chiave_esterna_child} = {$tabparent}.{$campiid["tabparent"]} order by {$ordine["tabchild"]}";
	$rs = esegui_query($con,$sql);
	$riga = 0;	
	while($r = getrecord($rs))
	{
			$colonna2 = optsel($con,$r[$campo_chiave_esterna_child],$tabparent,$ordine["tabparent"],$campiid,$campiparent);
			$colonna1 = $r[$campichild[1]];
			$colonna3 = $r[$campichild[2]];
			$colonna4 = $r[$campichild[3]];
			$strtabella .= "<tr class=\"riga{$riga}\"><td><input type=\"hidden\" value=\"{$r["idchild"]}\" id=\"i{$r["idchild"]}\" /><input class=\"form-control\" type=\"text\" id=\"a{$r["idchild"]}\" value=\"{$colonna1}\" /></td>";
			$strtabella .= "<td><select class=\"form-control\" id=\"b{$r["idchild"]}\">{$colonna2}</select></td>";
			$strtabella .= "<td><input type=\"text\" class=\"form-control\" id=\"c{$r["idchild"]}\" value=\"{$colonna3}\"></td>";
			$strtabella .= "<td><input type=\"text\" class=\"form-control\" id=\"d{$r["idchild"]}\" value=\"{$colonna4}\"></td>";
			
			if(isset($_SESSION["aut"]) &&($_SESSION["aut"] == 1) && isset($_SESSION["area"]) && (strpos($_SESSION["area"],$areaaut) !== false ) && isset($_SESSION["amministratore"][$areaaut]) && ($_SESSION["amministratore"][$areaaut] == 1)) 
			{
				$strtabella .= "<td style=\"text-align:center;\"><a href=\"#\" id=\"m{$r["idchild"]}\" onclick=\"modifica(this);return false;\" title=\"Modifica\"><span style=\"font-size:30px;\" class=\"glyphicon glyphicon-edit\"></span></a></td>";
				$strtabella .= "<td style=\"text-align:center;\"><a href=\"#\" id=\"r{$r["idchild"]}\" onclick=\"elimina(this);return false;\" title=\"Elimina\"><span style=\"font-size:30px;\" class=\"glyphicon glyphicon-trash\"></span></a></td>";
			}
				
			$strtabella .= "</tr>";	
			$riga++;
	}
		
		$strtabella .= "<tr id=\"rigaadd\"><td><input class=\"form-control\" type=\"text\" id=\"a0\" value=\"\" /></td>";
		$strtabella .= "<td id=\"selectparent\">&nbsp;</td>";
		$strtabella .= "<td><input type=\"text\" class=\"form-control\" id=\"c0\" value=\"\"></td>";
		$strtabella .= "<td><input type=\"text\" class=\"form-control\" id=\"d0\" value=\"\"></td>";
		
		if(isset($_SESSION["aut"]) &&($_SESSION["aut"] == 1) && isset($_SESSION["area"]) && (strpos($_SESSION["area"],$areaaut) !== false ) && isset($_SESSION["amministratore"][$areaaut]) && ($_SESSION["amministratore"][$areaaut] == 1)) 
			{
				$strtabella .= "<td style=\"text-align:center;\"><a href=\"#\" id=\"m0\" onclick=\"aggiungirigachild(this);return false;\" title=\"Aggiungi record\"><span style=\"font-size:30px;\" class=\"glyphicon glyphicon-save\"></span></a></td>";
				$strtabella .= "<td style=\"text-align:center;\">&nbsp;</td>";
				
			}
				
			$strtabella .= "</tr>";	
		
		$strtabella .= "</tbody></table>";


	
	
echo $strtabella;

?>
