<?
session_start();
header('Expires: Wed, 23 Dec 1980 00:30:00 GMT');
header('Last Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache Control: no-cache, must-revalidate');
header('Pragma: no-cache');
include("../../config.php");
include("../../libreria/util_func2.php");
include("../../libreria/util_form.php");
include("../../libreria/util_dbnew.php");
/* per ldap include("../libreria/auth_ldap.php"); */
$con = connessione($hostmysql,$usermysql,$pwdmysql,$dbmysql);

$usern = mysqli_real_escape_string($con,$_REQUEST["username"]);
$userp = mysqli_real_escape_string($con,$_REQUEST["password"]);
$qry = "select * from utenti where username = '{$usern}' and password = PASSWORD('{$userp}')";
/* con ldap
$qry = "select * from utenti where username = '{$usern}'";
*/
$rs = esegui_query($con,$qry);
if (numrec($rs) <= 0 )
{
	$data = date("d-m-Y H:i");
	$msg = "Login fallito: {$usern} - {$_SERVER["REMOTE_ADDR"]} - {$data}\r\n";
	$path = realpath("../../logs/") . "/acc_log.log";
	error_log($msg,3,$path);
	echo "no";
}
else
	/* per ldap if (!check_auth_ldap($usern,$userp))
		echo "no";
	else
	*/	
	{

	
		$r = getrecord($rs);
		$id = $r["id"];
		$utente = $r["username"];
		$qry = "select * from aree_aut where aree_aut.idutente = {$id}";
		$rs2 = esegui_query($con,$qry);
		$firstloop = true;
		$aree = "";
		while ($rec = getrecord($rs2))
		{
			if($firstloop)
			{
				$aree .= $rec["idarea"];
				$firstloop = false;
			}
			else
				$aree .= "," . $rec["idarea"];
			$_SESSION["amministratore"][$rec["idarea"]] = $rec["amministratore"];
		}

		$_SESSION["aut"] = 1;
		$_SESSION["idut"] = $id;
		$_SESSION["area"] = $aree;	
		
		$data = date("d-m-Y H:i");
		$msg = "Login avvenuto: {$usern} - {$_SERVER["REMOTE_ADDR"]} - {$data}\r\n";
		$path = realpath("../../logs/") . "/acc_log.log";
		error_log($msg,3,$path);
	
		echo "<p>Utente autenticato: {$utente}<br /><a style=\"color:#000000;font-weight:bold;\" title=\"Cambio password\"  href=\"../cambiopwd2/index.php\">-Cambio password</a><br /><a style=\"color:#000000;font-weight:bold;\" title=\"Chiudi sessione\" href=\"#\" onclick=\"logoutmobile();return false;\">-Chiudi sessione</a></p>";

	}
	 


?>
