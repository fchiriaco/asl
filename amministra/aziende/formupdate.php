<?php
session_start();
include("configlocale.php");
include("{$dirsito}config.php");
include("{$dirsito}libreria/util_func2.php");
if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],$areaaut) === false) || !isset($_SESSION["amministratore"][$areaaut]) || ($_SESSION["amministratore"][$areaaut] != 1))
{
	
	myalert("Utente non autorizzato","{$dirsitoscript}index.php");
	exit;
}
include($dirsito . "libreria/util_dbnew.php");
$con = connessione(HOST,USER,PWD,DBNAME);
$chiave = mysqli_real_escape_string($con,$_POST["chiave"]);
$sql = "select * from {$tabella} where {$campo_chiave} = {$chiave}";
$rs = esegui_query($con,$sql);
$r = getrecord($rs);

$stringaupd = '<form role="form" id="frmupd" method="post">';


foreach($campi_tabella as $k => $v)
{
	$stringaupd .= '<div class="form-group" style="padding:5px;">';
	$stringaupd .= '<label for="upd-' . $v . '">' . $k . ':</label>';
	$stringaupd .= ' <input type="text" class="form-control" id="upd-' . $v .  '" name="upd-' . $v . '" value="' . $r[$v] . '">';
	$stringaupd .= "</div>";
}

$stringaupd .= '<p class="text-center"><input type="hidden" id="campochiave" value="' . $chiave . '" name="campochiave"><button id="updbtn" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> SALVA RECORD</button> ';
$stringaupd .=  '<button id="rinunciaupd" type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> ANNULLA</button></p>';
$stringaupd .= '</form>';
echo $stringaupd;
?>
