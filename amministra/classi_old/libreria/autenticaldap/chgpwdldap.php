
<?php




function cambio_password_ldap($user,$oldPassword,$newPassword,$newPassword2)
{
  


	/* da cambiare con i dati del tuo server */

	$server = "ubuntuserver.francesco.loc";

	/* da cambiare con i dati del tuo server */
	$dn = "dc=francesco,dc=loc";
  
	$user = $user;






	$con = @ldap_connect($server);



	if($con === false)
		return 7;



	ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);



  
	if (ldap_bind($con,"uid=$user,ou=people,$dn",$oldPassword) === false) 
	{
    		/*Autenticazione fallita */ 
		return 1;
	}
	else { }
  
	if ($newPassword != $newPassword2 ) 
	{
    		/* Le password non corrispondono */ 
    		return 2;
	}
	if (strlen($newPassword) < 8 ) 
	{
    		/* Nuova password troppo corta */
    		return 3;
	}
	if (!preg_match("/[0-9]/",$newPassword)) 
	{
			/* password non contiene numeri */
        		return 4;
	}
	if (!preg_match("/[a-zA-Z]/",$newPassword)) 
	{
    		/* Password senza caratteri alfabetici */
    		return 5;
	}



  	$entry = array();
  	/* $entry["userPassword"] = "{crypt}" . base64_encode( pack( "H*", crypt( $newPassword ) ) );*/

    	$entry["userPassword"] = "{crypt}" . crypt( $newPassword );
  
  	if (ldap_modify($con,"uid=$user,ou=people,$dn",$entry) === false)
	{
		/* modifica fallita */
 		return 6;   
  	}
  	else 
	{ 
    
    	}

 	/* modifica password riuscita */
	return 0; 

}  


if(isset($_POST["submit"]))
{ 
	
	$ret = cambio_password_ldap($_POST["user"],$_POST["oldpasswd"],$_POST["passwd1"],$_POST["passwd2"]);
	
	switch($ret)
	{
		case 1:
			echo "Autenticazione fallita";
			exit;
			break;
		case 2:
			echo "Le password non corrispondono";
			exit;
			break;
		case 3:
			echo "Password troppo corta";
			exit;
			break;
		case 4:
			echo "La password non contiene numeri";
			exit;
			break;
		case 5:
			echo "La password non contiene caratteri";
			exit;
			break;
		case 6:
			echo "Modifica fallita";
			exit;
			break;
		case 7:
			echo "Connessione ldap fallita";
			exit;
			break;
		default:
			echo "Password modificata con successo";
			exit;
			break;
	}
	
		
}  
?>
<html>
<head><title>Autenticazione con ldap</title></head>
<body>

<div style="margin:auto auto;width:500px;">

<h1>Modulo cambio password con ldap</h1>

<form id="modulo" name="modulo" method="post" action="<? echo $_SERVER["PHP_SELF"]; ?>">
<table>
<tr><td><label for="user">Nome utente</label></td><td><input type="text" name="user" id="user" /></td></tr>
<tr><td><label for="oldpasswd">Vecchia password</label></td><td><input type="password" name="oldpasswd" id="oldpasswd" /></td></tr>
<tr><td><label for="passwd1">Nuova password</label></td><td><input type="password" name="passwd1" id="passwd1" /></td></tr>
<tr><td><label for="passwd2">Ripeti nuova password</label></td><td><input type="password" name="passwd2" id="passwd2" /></td></tr>
<tr><td colspan="2" style="text-align:center;"><input type="submit" name="submit" id="submit" value="Conferma" /></td></tr>
</table>
</form>


</div>

</body>
</html>



