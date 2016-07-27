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

if(isset($crea_account) && $crea_account == 1)
{
		
	$qry = "select {$chiave_esterna_utente} from  {$tabella} where  {$campo_chiave} = ";
	$qry .=  (($tipo_chiave == "s") ? "'" . $chiave . "'" : $chiave);  
	$rsuser = esegui_query($con,$qry);
	$ruser = getrecord($rsuser);
	$utcorrente = $ruser[$chiave_esterna_utente];
}


if($tipo_chiave == "n")
	$query = "delete from {$tabella} where {$campo_chiave} = {$chiave}";
else 
	$query = "delete from {$tabella} where {$campo_chiave} = '{$chiave}'";
$ret = esegui_query($con,$query);
if(!$ret)
	echo "Errore!!";
else
{
	if(isset($crea_account) && $crea_account == 1)
	{
		$sql = "delete from {$tabella_utenti} where {$campo_chiave_utenti} = " . (($tipo_chiave_utenti == "s") ? "'" . $utcorrente . "'" : $utcorrente);
		$ret = esegui_query($con,$sql);
		if(!$ret)
			echo "Errore!!";
		else
			echo "Record Cancellato con successo";
		exit;
	}
	echo "Record Cancellato con successo";
}
?>