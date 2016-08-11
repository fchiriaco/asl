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
if(isset($crea_account) && $crea_account == 1)
	$sqlins2 = ",idutente) values (";
else
	$sqlins2 = ") values (";
$i = 0;

if(isset($crea_account) && $crea_account == 1)
{
	
	$stringa_ins_utente = "insert into {$tabella_utenti}(";
	$stringa2_ins_utente = ") values (";
	$j = 0;
	$last_id_user;
	function check_user($con,$tabella_ut,$nomecampouser,$valorecampouser)
	{
		$sql = "select * from {$tabella_ut} where {$nomecampouser} = '{$valorecampouser}'";
		$rs = esegui_query($con,$sql);
		if(numrec($rs) > 0)
			return false;
		else
			return true;
		
	}
	foreach($campi_account as $v)
	{
		
		$stringa_ins_utente .= ($j == 0) ? $v: "," . $v;
		$campo = mysqli_real_escape_string($con,$_POST["add-" . $v]);
		if(trim($campo) == "")
		{
			echo "Errore campo " . $v . " obbligatorio!!!";
			exit;
		}
		if($tipo_campi_account[$v] == "s")
		{
			
			$stringa2_ins_utente .= ($j == 0) ? "'" . $campo . "'" : "," . "'" . $campo . "'";
		}
		elseif($tipo_campi_account[$v] == "d")
		{
			$stringa2_ins_utente .= ($j == 0) ? "'" . dataperdb2($campo) . "'" : "," . "'" . dataperdb2($campo) . "'";
		}
		elseif($tipo_campi_account[$v] == "p")
		{
			
			$stringa2_ins_utente .= ($j == 0) ? "password('" . $campo . "')" : ",password('" . $campo . "')";
		}
		else
		{
			$stringa2_ins_utente .= ($j == 0) ? "" . $campo : "," . $campo;
		}
		
		$j++;	
	}
	$valorecampouser =  mysqli_real_escape_string($con,$_POST["add-" . $campo_nome_utente]);
	$stringa2_ins_utente .= ")";
	$stringa_ins_utente .= $stringa2_ins_utente;
	if(check_user($con,$tabella_utenti,$campo_nome_utente,$valorecampouser) === false)
	{
		echo "Errore nome utente occupato";
		exit;
	}
	$ret = esegui_query($con,$stringa_ins_utente);
	if($ret === false)
	{
		echo "Errore!!";
		exit;
	}
	$lastidutente = mysqli_insert_id($con);
	
	$sqlaree = "insert into {$tabella_aree_autorizzazione} values (?,?,?)";
	$stmt = $con->prepare($sqlaree);
	$stmt->bind_param("ssi",$area,$lastidutente,$level);
	$k = 0;
	foreach($aree_autorizzate as $area)
	{
		$level = $livello[$k];
		$stmt->execute();
	}
}

foreach($campi_tabella as $v)
{
		
	$sqlins .= ($i == 0) ? $v  : "," . $v;
	
	$campo = mysqli_real_escape_string($con,$_POST["add-" . $v]);
	if($tipo_campi_tabella[$v] == "s")
		$sqlins2 .= ($i == 0) ? "'" . $campo . "'" : "," . "'" . $campo . "'";
	elseif($tipo_campi_tabella[$v] == "d")
		$sqlins2 .= ($i == 0) ? "'" . dataperdb2($campo) . "'" : "," . "'" . dataperdb2($campo) . "'";
	elseif($tipo_campi_tabella[$v] == "p")
		$sqlins2 .= ($i == 0) ? "MD5('" . $campo . "')" : "," . "MD5('" . $campo . "')";
	else
		$sqlins2 .= ($i == 0) ? "" . $campo : "," . $campo;
	$i++;
}
if(isset($crea_account) && $crea_account == 1)
	$sqlins .= $sqlins2 . ",{$lastidutente})";
else
	$sqlins .= $sqlins2 . ")";

$ret = esegui_query($con,$sqlins);
if($ret === false)
	echo "Errore!!";
else
	echo "Record inserito con successo";

?>