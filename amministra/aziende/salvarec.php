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

$sqlins = "insert into {$tabella} (";
$sqlins2 = ") values (";
$i = 0;
foreach($campi_tabella as $v)
{
	$sqlins .= ($i == 0) ? $v  : "," . $v;
	
	$campo = mysqli_real_escape_string($con,$_POST["add-" . $v]);
	$sqlins2 .= ($i == 0) ? "'" . $campo . "'" : "," . "'" . $campo . "'";
	$i++;
}

$sqlins .= $sqlins2 . ")";

$ret = esegui_query($con,$sqlins);
if($ret === false)
	echo "Errore!!";
else
	echo "Record inserito con successo";

?>