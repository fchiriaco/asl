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


/* controllo campi obbligatori non vuoti */
foreach($campi_obbligatori_ins_upd as $v)
{
	if(!isset($_POST["upd-" . $v]) || (trim($_POST["upd-" . $v]) == ""))
	{
		echo "Errore: campo " . $v . " obbligatorio!!!";
		exit;
	}
	
}


$campochiave = mysqli_real_escape_string($con,$_POST["campochiave"]);
$sqlupdate = "update {$tabella} set ";

$i = 0;
foreach($campi_tabella as $v)
{
		
	$campo = mysqli_real_escape_string($con,$_POST["upd-" . $v]);
	$sqlupdate  .= ($i == 0) ? $v . "= '" . $campo . "'" : "," . $v . "= '" . $campo . "'";
	$i++;
}

$sqlupdate .= " where {$campo_chiave} = {$campochiave}";

$ret = esegui_query($con,$sqlupdate);
if($ret === false)
	echo  "Errore!!";
else
	echo "Record aggiornato con successo!!";

?>