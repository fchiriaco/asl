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

if(isset($crea_account) && $crea_account == 1)
{
	$chiaveesterna = $r[$chiave_esterna_utente];
	if($tipo_chiave_esterna == "s")
		$sql = "select {$campo_nome_utente} from {$tabella_utenti} where {$campo_chiave_utenti} = '{$chiaveesterna}'";
	else
		$sql = "select {$campo_nome_utente} from {$tabella_utenti} where {$campo_chiave_utenti} = {$chiaveesterna}";
	$rsut = esegui_query($con,$sql);
	$rut = getrecord($rsut);
	$nomeutente = $rut[$campo_nome_utente];
}

$stringaupd = '<form role="form" id="frmupd" method="post">';


foreach($campi_tabella as $k => $v)
{
	$stringaupd .= '<div class="form-group" style="padding:5px;">';
	$stringaupd .= '<label for="upd-' . $v . '">' . $k . ':</label>';
	$stringaupd .= ' <input type="text" class="form-control" id="upd-' . $v .  '" name="upd-' . $v . '" value="' . $r[$v] . '">';
	$stringaupd .= "</div>";
}

if($crea_account == 1)
{
	$stringaupd .= '<div class="bg-primary">';
	foreach($campi_account as $k => $v)
	{
		$stringaupd .= '<div class="form-group" style="padding:5px;">';
		$stringaupd .= '<label for="upd-' . $v . '">' . $k . ':</label>';
		if($v == $campo_nome_utente)
			$stringaupd .= ' <input type="text" class="form-control" id="upd-' . $v .  '" name="upd-' . $v . '" value="' . $nomeutente . '">';
		else
			$stringaupd .= ' <input type="text" class="form-control" id="upd-' . $v .  '" name="upd-' . $v . '">';
		$stringaupd .= "</div>";
		
	}
	$stringaupd .= '<br></div><br>';
}

$stringaupd .= '<p class="text-center"><input type="hidden" id="campochiave" value="' . $chiave . '" name="campochiave"><button id="updbtn" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> SALVA RECORD</button> ';
$stringaupd .=  '<button id="rinunciaupd" type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> ANNULLA</button></p>';
$stringaupd .= '</form>';
echo $stringaupd;
?>
