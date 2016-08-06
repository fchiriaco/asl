<?php
session_start();
include("configlocale.php");
include("{$dirsito}config.php");
include("{$dirsito}libreria/util_dbnew.php");
include("{$dirsito}libreria/util_func2.php");


if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],$areaaut) === false) || !isset($_SESSION["amministratore"][$areaaut]) || ($_SESSION["amministratore"][$areaaut] != 1))
{
	echo "Utente non autorizzato!";
	exit;
}
$con = connessione(HOST,USER,PWD,DBNAME);
$campo1 = htmlentities(addslashes(trim($_POST["campo1"]))) . "";
$campo2 = intval(htmlentities(addslashes(trim($_POST["campo2"]))));
$campo3 = htmlentities(addslashes(trim($_POST["campo3"]))) . "";
$campo4 = intval(htmlentities(addslashes(trim($_POST["campo4"]))));


if($campo2 == 0)
{
	echo "Dati incompleti...";
	exit;	
}
if($campo1 == "")
{
	echo "Dati incompleti...";
	exit;	
}
if($campo3 == "")
{
	echo "Dati incompleti...";
	exit;	
}

$sql = "insert into {$tabchild} values (null,'{$campo1}','{$campo3}',{$campo4},{$campo2})";
$rs = esegui_query($con,$sql);
if(!$rs)
{
	echo "ERRORE DATABASE";
	exit;
}
echo "Dati modificati con successo!";
?>
