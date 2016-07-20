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
if(!isset($_POST["chiave"]))
{
	echo "Errore durante la cancellazione del record";
	exit;
}
$chiave = $_POST["chiave"];
if($tipo_chiave == "n")
	$query = "delete from {$tabella} where {$campo_chiave} = {$chiave}";
else 
	$query = "delete from {$tabella} where {$campo_chiave} = '{$chiave}'";
$ret = esegui_query($con,$query);
if(!$ret)
	echo "Errore!!";
else
	echo "Record Cancellato con successo";
?>