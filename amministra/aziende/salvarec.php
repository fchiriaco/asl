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
	if(!isset($_POST["add-" . $v]) || (trim($_POST["add-" . $v]) == ""))
	{
		echo "Errore: campo " . $v . " obbligatorio!!!";
		exit;
	}
	
}


/* controllo record ripetuti */
$stringa_query_univocita = "select * from {$tabella} where ";
$i = 0;
$campo_where_current = ""; 
foreach($campi_unici_tabella as $v)
{
	switch($tipo_campi_unici_tabella[$i])
	{
		
		case "s":
			$campo_where_current = $v . " = '" .  mysqli_real_escape_string($con,$_POST["add-" . $v]) . "'";
			break;
		case "n":
			$campo_where_current = $v . " = " .  mysqli_real_escape_string($con,$_POST["add-" . $v]);
			break;
		case "d":
			$campo_where_current = $v . " = '" .  dataperdb2(mysqli_real_escape_string($con,$_POST["add-" . $v])) . "'";
			break;
	}
	
	if($i == 0)
		
		$stringa_query_univocita .= $campo_where_current;
	else
		$stringa_query_univocita .= " and " . $campo_where_current . " ";
	
	$i++;
}
	
$rscheck = esegui_query($con,$stringa_query_univocita);
if(numrec($rscheck) > 0 )
{
	echo "Errore: record duplicato, impossibile aggiungere";
	exit;
}	





$sqlins = "insert into {$tabella} (";
$sqlins2 = ") values (";
$i = 0;
foreach($campi_tabella as $v)
{
	$sqlins .= ($i == 0) ? $v  : "," . $v;
	
	$campo = mysqli_real_escape_string($con,$_POST["add-" . $v]);
	if($tipo_campi_tabella[$v] == "s")
		$sqlins2 .= ($i == 0) ? "'" . $campo . "'" : "," . "'" . $campo . "'";
	else if($tipo_campi_tabella[$v] == "d")
		$sqlins2 .= ($i == 0) ? "'" . dataperdb2($campo) . "'" : "," . "'" . dataperdb2($campo) . "'";
	else
		$sqlins2 .= ($i == 0) ? "" . $campo : "," . $campo;
	$i++;
}

$sqlins .= $sqlins2 . ")";

$ret = esegui_query($con,$sqlins);
if($ret === false)
	echo "Errore!!";
else
	echo "Record inserito con successo";

?>