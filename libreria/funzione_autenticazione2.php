<?PHP
/* 
Autore: Francesco Chiriaco
parametri funzione:
$myquery: query di autenticazione
$area_autenticare: area a cui si deve avere accesso
$necessario_amministratore: 0/1 indica se per l'accesso è necessario essere amministratore
$querystr: la query string da accodare al link di ritorno
$valoreidut: identificativo dell'utente che deve avere accesso
$nomecampouser: nome del campo username nella tabella di autenticazione
$nomecampopassword: nome del campo password nella tabella di autenticazione
$nomecampoid: nome del campo contenente l'ID dell'utente
$paginaindice: pagina a cui tornare

per utilizzare questa funzione è necessario utilizzare 3 tabelle
1) tabella contenente gli utenti
2) aree_aut tabella che collega gli utenti con le aree a cui possono avere accesso
3) sezioni_aut tabella delle aree di accesso esistenti


esempio di chiamata:

if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],"docenti") === false) || ($_SESSION["idut"] != $_REQUEST["idutente"])) 
{
	if (!autentica_ut3("select * from utenti,aree_aut where utenti.id = aree_aut.idutente","docenti",0,"?id={$_REQUEST["id"]}&amp;idutente={$_REQUEST["idutente"]}",$_REQUEST["idutente"]))
		exit;
}


if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],"admin") === false) || !isset($_SESSION["amministratore"]["admin"]) || ($_SESSION["amministratore"]["admin"] != 1)) 
{
	if (!autentica_ut3("select * from utenti,aree_aut where utenti.id = aree_aut.idutente","admin",1))
		exit;
}

if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],"cistituto") === false)) 
{
	if (!autentica_ut3("select * from utenti,aree_aut where utenti.id = aree_aut.idutente","cistituto",0))
		exit;
}
*/




function autentica_ut3($con,$myquery = "",$area_autenticare = "news",$necessario_amministratore = 0,$paginaindice = "../index.php",$querystr = "",$valoreidut = 0,$nomecampouser="username",$nomecampopassword="password",$nomecampoid = "")
{
 
 if (isset($_POST["pwd"]) && isset($_POST["uname"])) 
   {
	if((strpos($_POST["pwd"],"'") !== false) || (strpos($_POST["uname"],"'") !== false))
	{
		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>\n";
      		echo "</body>\n";
  		echo "</html>";
		return false;
	}
	if((strpos($_POST["pwd"],"\"") !== false) || (strpos($_POST["uname"],"\"") !== false))
	{
		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>\n";
      		echo "</body>\n";
  		echo "</html>";
		return false;
	}
    
    $uname = filter_var($_POST["uname"],FILTER_SANITIZE_STRING);
	$pwd =    filter_var($_POST["pwd"],FILTER_SANITIZE_STRING);
	if(empty($valoreidut))
		$qrytxt = $myquery . " and $nomecampouser = '{$uname}' and $nomecampopassword = password('" . $pwd . "')";
	else
		$qrytxt = $myquery . " and $nomecampouser = '{$uname}' and $nomecampopassword = password('" . $pwd . "') and id = {$valoreidut}";
	$qry = esegui_query($con,$qrytxt);
 	if (numrec($qry) <= 0)
    	{
      		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>\n";
      		echo "</body>\n";
  		echo "</html>";
		return false;
		
	}
	
	$firstloop = true;
	$aree = "";
	$autenticato = false;
	while ($rec = getrecord($qry))
	{
		if($firstloop)
		{
			$aree .= $rec["idarea"];
			$firstloop = false;
		}
		else
			$aree .= "," . $rec["idarea"];

		if(($rec["idarea"] == $area_autenticare) && (($rec["amministratore"] == $necessario_amministratore) || ($rec["amministratore"] == 1)))
		{
			
			$_SESSION["aut"] = 1;
			$_SESSION["amministratore"][$rec["idarea"]] = $rec["amministratore"];
			if($nomecampoid == "")
				$_SESSION["idut"] = $rec["id"];
			else 
				$_SESSION["idut"] = $rec[$nomecampoid];
			$autenticato = true;
		}
		
	}
	
	if($autenticato)
	{		
		$_SESSION["area"] = $aree;
	   	return true;
	}
	else
	{
		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>";
		echo "</body>";
  		echo "</html>";
      		return false;
	
	}
	
   }
  elseif(( isset($_SESSION["aut"]) && ($_SESSION["aut"] == 1)) && (isset($_SESSION["area"]) && (strpos($_SESSION["area"],$area_autenticare) !== false)) && (isset($_SESSION["amministratore"]) && (($_SESSION["amministratore"][$area_autenticare] == $necessario_amministratore) || (isset($rec["amministratore"]) &&  ($rec["amministratore"][$area_autenticare] == 1)))) && (empty($valoreidut) || (isset($_SESSION["idut"]) && ($_SESSION["idut"] == $valoreidut))))
	return true;
 else 
 {
 ?>
  <form id="aut" method="post" action=<?PHP echo "\"" . $_SERVER["PHP_SELF"] . $querystr . "\""; ?>>
  <table class="mytable31new">
  <tr><td colspan="2" class="centrato"><b>Autenticazione utente</b></td></tr>
  <tr>
  <td style="text-align:right;">Utente:</td><td><input type="text" name="uname" /></td>
  </tr>
  <tr>
  <td style="text-align:right;">Password:</td> <td><input type="password" name="pwd" /></td>
  </tr>
  <tr>
  <td colspan="2" class="centrato"><input type="submit" name="invia" value="ACCEDI" /></td>
  </tr>
  </table>
  </form>
  </body>
  </html>
<?PHP
  
 }
} 

/* funzione con ldap



function autentica_ut3($con,$myquery = "",$area_autenticare = "news",$necessario_amministratore = 0,$paginaindice = "../index.php",$querystr = "",$valoreidut = 0,$nomecampouser="username",$nomecampopassword="password",$nomecampoid = "")
{
 
 if (isset($_POST["pwd"]) && isset($_POST["uname"])) 
   {
      
	if((strpos($_POST["pwd"],"'") !== false) || (strpos($_POST["uname"],"'") !== false))
	{
		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>\n";
      		echo "</body>\n";
  		echo "</html>";
		return false;
	}
	if((strpos($_POST["pwd"],"\"") !== false) || (strpos($_POST["uname"],"\"") !== false))
	{
		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>\n";
      		echo "</body>\n";
  		echo "</html>";
		return false;
	}
	if(empty($valoreidut))
		$qrytxt = $myquery . " and $nomecampouser = '{$_POST["uname"]}'";
	else
		$qrytxt = $myquery . " and $nomecampouser = '{$_POST["uname"]}' and id = {$valoreidut}";
	$qry = esegui_query($con,$qrytxt);
 	if (numrec($qry) <= 0)
    	{
      		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>\n";
      		echo "</body>\n";
  		echo "</html>";
		return false;
		
	}
	if (!check_auth_ldap($_POST["uname"],$_POST["pwd"]))
	{
		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>\n";
      		echo "</body>\n";
  		echo "</html>";
		return false;

	}

	$firstloop = true;
	$aree = "";
	$autenticato = false;
	while ($rec = getrecord($qry))
	{
		if($firstloop)
		{
			$aree .= $rec["idarea"];
			$firstloop = false;
		}
		else
			$aree .= "," . $rec["idarea"];

		if(($rec["idarea"] == $area_autenticare) && (($rec["amministratore"] == $necessario_amministratore) || ($rec["amministratore"] == 1)))
		{
			
			$_SESSION["aut"] = 1;
			$_SESSION["amministratore"][$rec["idarea"]] = $rec["amministratore"];
			if($nomecampoid == "")
				$_SESSION["idut"] = $rec["id"];
			else 
				$_SESSION["idut"] = $rec[$nomecampoid];
			$autenticato = true;
		}
		
	}
	
	if($autenticato)
	{		
		$_SESSION["area"] = $aree;
	   	return true;
	}
	else
	{
		echo "<p style=\"text-align:center;fontweight:bold;\">Utente non autorizzato<br /><br /><a href=\"{$paginaindice}{$querystr}\">Torna Indietro</a>";
		echo "</body>";
  		echo "</html>";
      		return false;
	
	}
	
   }
 elseif(( isset($_SESSION["aut"]) && ($_SESSION["aut"] == 1)) && (isset($_SESSION["area"]) && (strpos($_SESSION["area"],$area_autenticare) !== false)) && (isset($_SESSION["amministratore"]) && (($_SESSION["amministratore"][$area_autenticare] == $necessario_amministratore) || (isset($rec["amministratore"]) &&  ($rec["amministratore"][$area_autenticare] == 1)))) && (empty($valoreidut) || (isset($_SESSION["idut"]) && ($_SESSION["idut"] == $valoreidut))))
	return true;
 else 
 {
 ?>
  <form id="aut" method="post" action=<?PHP echo "\"" . $_SERVER["PHP_SELF"] . $querystr . "\""; ?>>
  <table class="mytable31new">
  <tr><td colspan="2" class="centrato"><b>Autenticazione utente</b></td></tr>
  <tr>
  <td style="text-align:right;">Utente:</td><td><input type="text" name="uname" /></td>
  </tr>
  <tr>
  <td style="text-align:right;">Password:</td> <td><input type="password" name="pwd" /></td>
  </tr>
  <tr>
  <td colspan="2" class="centrato"><input type="submit" name="invia" value="ACCEDI" /></td>
  </tr>
  </table>
  </form>
  </body>
  </html>
<?PHP
  
 }
} 

*/

?>
