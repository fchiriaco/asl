<?php

function crea_cartella_priv($username,$password,$path = "/web/htdocs/www.liceopigafetta.it/home/pigafetta/docenti/gestfileprivati/fprivati/")
{
	$rigatipoauth = "AuthType Basic";
	$rigaauthname = "AuthName \"Area protetta docenti\"";
	$rigaauthuserfile = "AuthUserFile " . $path . $username  .  "/.htpasswd";
	$rigaauthrequire = "require valid-user";
	
	$contenuto = $rigatipoauth . "\n" . $rigaauthname . "\n" .$rigaauthuserfile . "\n" . $rigaauthrequire; 
	$pathfile = $path . $username . "/.htaccess"; 
	mkdir($path . $username);
	chmod($path . $username,0777);
	$f = fopen($pathfile,"w+");
	fwrite ( $f , $contenuto);
	fclose($f); 
	
	$rigapasswd = $username . ":" . $password;
	$pathfile = $path . $username . "/.htpasswd";
	$f = fopen($pathfile,"w+");
	fwrite ( $f , $rigapasswd);
	fclose($f); 
	
}


function crea_file_htpasswd($username,$password,$path = "/web/htdocs/www.liceopigafetta.it/home/pigafetta/docenti/gestfileprivati/fprivati/")
{
	 
	
	$rigapasswd = $username . ":" . $password;
	$pathfile = $path . $username . "/.htpasswd";
	$f = fopen($pathfile,"w+");
	fwrite ( $f , $rigapasswd);
	fclose($f); 
	
}
?>