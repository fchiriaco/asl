<?php
include("../config.php");
include("../libreria/util_db.php");
include("../libreria/util_func2.php");
include("../libreria/util_form.php");
/* aggiunta area privata */
include("area_privata_docenti.php");


$messaggio = "Compilare tutti i campi del modulo e cliccare sul pulsante esegui";

function check_auth_ldap($login,$password)
{
  $l=trim($login);
  $p=trim($password);
  if (($p=="") || ($l==""))
    return "Login o password vuoti";
  if (!($ldapconn=ldap_connect("127.0.0.1")))
    return "Errore connessione LDAP";
  if (!ldap_set_option($ldapconn,LDAP_OPT_PROTOCOL_VERSION,3))
    return "Errore protocollo LDAP";
  if ($ldapbind=@ldap_bind($ldapconn,"uid=$l,ou=Users,dc=itcpiovene,dc=net",$p))
    return "OK";
  else
    return "Login errato";
}






if(isset($_POST["submit"]))
{
	$login=addslashes(trim($_REQUEST["login"]));
	$pwd=addslashes(trim($_REQUEST["pwd"]));
	$pwd1=addslashes(trim($_REQUEST["pwd1"]));
	$pwd2=addslashes(trim($_REQUEST["pwd2"]));

	$con = connessione($hostmysql,$usermysql,$pwdmysql,$dbmysql);

	$qry = "select * from utenti where username = '{$login}' and password = PASSWORD('{$pwd}')";
	$rs = esegui_query($qry);
	
	if ($login=="root")
  		$login="";

	if ($login!="")
	{
  		unset($e);
		$e="";
  		if ($pwd=="")
    			$e="Password vuota";
  		else if ($pwd1=="")
    			$e="Nuova password vuota";
  		else if ($pwd1!=$pwd2)
    			$e="Le nuove password non coincidono";
		else if (numrec($rs) <= 0)
			$e="Utente sconosciuto";

  			/* solo per ldap else if (check_auth_ldap($login,$pwd)!="OK")
    			$e="Password attuale non corretta"; */
		if ($e!="")
	    		$messaggio= $e;
  		else
  		{
    				/* solo per ldap if (@system("/home/staff/dalla/phpwrapper/phppasswd $login $pwd1")==0)
      					$messaggio= "Password cambiata correttamente";
				else
      					$messaggio= "Problemi tecnici per il cambio password";
				*/
				$qry2 = "update utenti set password = PASSWORD('{$pwd1}') where username = '{$login}'";
				esegui_query($qry2);
				/* aggiunta area privata docenti */

				/* crea_file_htpasswd($login,crypt($pwd1),"../docenti/gestfileprivati/fprivati/"); */
		
				/* fine aggiunta area privata */

				$messaggio= "Password cambiata correttamente"; /* togliere con ldap */
  		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="../stilenuovo.css" />
<link rel="stylesheet" type="text/css" href="../nuovocss.css" />
<!--[if LT IE 7]><link rel="stylesheet" type="text/css" href="../css/iefix.css" /><![endif]-->
<title>Cambio password</title>
<script type="text/javascript" src="./ajax.js"></script>
<script type="text/javascript" src="../javascript/onfocus.js"></script>
<script type="text/javascript">
function valida()
{
	login = encodeURIComponent(document.getElementById("login").value);
	pwd = encodeURIComponent(document.getElementById("pwd").value);
	pwd1 = encodeURIComponent(document.getElementById("pwd1").value);
	pwd2 = encodeURIComponent(document.getElementById("pwd2").value);
	if (login == "" || pwd == "" || pwd1 == "" || pwd2 == "")
	{
		alert("Tutti i campi sono obbligatori");
		return false;
	}
	else
		return true;
}
</script>
</head>
<body>
<div class="container">
  <div class="row">
	<div class="col-md-12" id="menu"><?php include("../barramenu.php") ?></div>
  </div>
  
  <div class="row">
	<div class="col-md-12" id="menu">
		<div style="position:relative;text-align:center;margin:0px 0px;padding:0px;color:#000000;z-index:4;">
			<h3 class="centro alert alert-info" >Cambio password</h3>
		</div>

		<div class="cambiopwd">
		<?

		$campi[] = array("tipo" => "text","valore" => "","lunghezza" => 40,"nome" => "login","etichetta" => "Nome utente");
		$campi[] = array("tipo" => "password","valore" => "","lunghezza" => 40,"nome" => "pwd","etichetta" => "Password");
		$campi[] = array("tipo" => "password","valore" => "","lunghezza" => 40,"nome" => "pwd1","etichetta" => "Nuova password");
		$campi[] = array("tipo" => "password","valore" => "","lunghezza" => 40,"nome" => "pwd2","etichetta" => "Ripetere nuova password");
		$campi[] = array("tipo" => "submit","valore" => "Esegui","lunghezza" => 20,"nome" => "submit","etichetta" => "");
		form_generica($campi,"change","",$_SERVER["PHP_SELF"],"mytable31bis","stile3",1,1,"valida()");
		?>

		</div>
		<div id="risposta" class="alert alert-info" style="position:relative;margin:15px auto;width:100%;text-align:center;">
		<h4><? echo $messaggio; ?></h4>
		</div>
	</div>
  </div>
</div>
  
  
<!-- <div style="position:relative;text-align:right;margin:3px auto;padding:0px 5px;color:#000000;z-index:4;font-size:0.75em;">
| Dove ti trovi: <a id="posfocus" class="orienta" title="HOME" href="../index.php">Home-&gt;</a>Cambio password |
</div> -->



<script src="../bootstrap/js/jquery-1.10.2.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
