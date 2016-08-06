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

$campoparent1 = trim(filter_var($_POST["campoparent1"],FILTER_SANITIZE_STRING));


if($campoparent1 == "")
{
	echo "Dati incompleti...";
	exit;	
}
$campoparent2 = trim(filter_var($_POST["campoparent2"],FILTER_SANITIZE_STRING));
$campoparent3 = trim(filter_var($_POST["campoparent3"],FILTER_SANITIZE_STRING));
$campoparent4 = trim(filter_var($_POST["campoparent4"],FILTER_SANITIZE_STRING));
$campoparent5 = trim(filter_var($_POST["campoparent5"],FILTER_SANITIZE_STRING));

$sql = "select * from {$tabparent} where {$campiparent[1]} = '{$campoparent1}'";
$rs = esegui_query($con,$sql);
if(numrec($rs) > 0)
{
		echo "Record già presente in archivio...";
		exit;
}
$sql = "insert into {$tabparent} values (null,'{$campoparent1}','{$campoparent2}','{$campoparent3}','{$campoparent4}','{$campoparent5}')";
$rs = esegui_query($con,$sql);
if(!$rs)
{
	echo "ERRORE DATABASE";
	exit;
}
echo "Dati caricati con successo!";
?>
