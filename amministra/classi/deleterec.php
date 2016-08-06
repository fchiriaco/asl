<?php
session_start();
include("configlocale.php");
include("{$dirsito}config.php");
include("{$dirsito}libreria/util_dbnew.php");
include("{$dirsito}libreria/util_func2.php");



if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],$areaaut) === false) || !isset($_SESSION["amministratore"][$areaaut]) || ($_SESSION["amministratore"][$areaaut] != 1)) 
{
	echo "Non si possiedono le credenziali per questa operazione!!";
	exit;
}
$con = connessione(HOST,USER,PWD,DBNAME);
$sql = "delete from {$tabchild} where {$campiid["tabchild"]} = {$_POST["id"]}";
$rs = esegui_query($con,$sql);
if(!$rs)
{
	echo "ERRORE DATABASE";
	exit;
}
echo "";
?>
