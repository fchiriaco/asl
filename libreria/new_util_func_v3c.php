<?
/*
creatabella_dati($qry,$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$nometabella="utenti",$campok="id",$tipok="numerico")
Crea una vista dei dati sotto forma di tabela
Parametri
$qry: query su tabella
$bordo: bordo tabella
$backcolor: colore sfondo tabella
$backheader: colore sfondo intestazione
$id = identificativo oggetto tabella
$nometabella: nome tabella di riferimento
$campok: nome campo chiave
$tipok: tipologia della chiave "numerico" o "testo"
*/
function creatabella_dati($qry,$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$nometabella="utenti",$campok="id",$tipok="numerico")
{
 
 if (isset($_POST["submit1"]))
  {
    	unset($_POST["submit1"]);
	$qrydet = (($tipok == "numerico") ? "select * from $nometabella where $campok={$_POST["valoreid"]}":"select * from $nometabella where $campok='{$_POST["valoreid"]}'");	
    	$resultqry1 = esegui_query($qrydet);	
	$rec = getrecord($resultqry1);
	$ncampi = getnumcampi($resultqry1);
	echo "<script language=\"javascript\" type=\"text/javascript\">";	
	echo "wnd = window.open('','Dettagli','toolbar=no,menubar=no,top=20,left=40,height=400,width=400');";
	echo "wnd.document.write('<h3 style=\"text-align:center\">Ulteriori Informazioni</h3>');";
	echo "wnd.document.write('<div style=\"margin:0px auto;padding:0px;text-align:center\">');";
	
	echo "wnd.document.write('<table style=\"background-color:#339999;text-align:center;border:0\">');";
	
	for($i = 0;$i < $ncampi;$i++)
	 {
	   $nomec = getnomecampo($resultqry1,$i);
	   if (($rec[$nomec] != NULL) & ($rec[$nomec] != ""))
	    echo "wnd.document.write('<tr><td style=\"background-color:#99ffcc;text-align:right\"><b>$nomec: </b></td><td style=\"background-color:#ccccff\">$rec[$nomec]</td></tr>');";
	 }
	 echo "wnd.document.write('</table>');";
	 echo "wnd.document.write('</div>');";
	 echo "wnd.document.write('<p style=\"text-align:center\"><input type=button value=Chiudi onclick=\"window.close();\"></p>');";
	echo "</script>";
  }
 $resultqry = esegui_query($qry);
 if (numrec($resultqry) == 0)
 	echo "<b>Nessun record Trovato</b>";
 else
 {
 	$numcolonne = getnumcampi($resultqry);
	echo "<table cellpadding=\"0\" cellspacing=\"2\" style=\"border:solid {$bordo}px;background-color:$backcolor\" id=\"$id\">";
	echo "<tr>";
	for($i = 0;$i < $numcolonne;$i++)
	 {
		$nc = getnomecampo($resultqry,$i);
		echo "<th style=\"background-color:$backheader;border:solid {$bordo}px;\">$nc</th>";
	 }
	 echo "<th style=\"background-color:$backheader;border:solid {$bordo}px;\">Dettagli</th>";
	 echo "</tr>";
	 while(($record = getrecord($resultqry)))
	  {
	    echo "<tr>";
	  	for($i = 0;$i < $numcolonne;$i++)
	     {
		   $nc = getnomecampo($resultqry,$i);
		   echo "<td style=\"text-align:left;border:solid {$bordo}px;\">$record[$nc]" .  "&nbsp;" . "</td>";
		   
	     }
		 echo "<td style=\"text-align:center;border:solid {$bordo}px;\">";
		 form_crea("r" . $record[$campok],1,$_SERVER["HTTP_REFERER"]);
		 echo "<div>";
		 form_casella_testo_nascosta("valoreid",$record[$campok]);
		 form_invia("Dettagli","submit1");
		 echo "</div>";
		 
		 echo "</td>";
		 echo "</tr>";
		 form_chiudi();
	  }
    echo "</table>";
 }
}	



/* funzione canc_dati_tabella($qry,$nometabella,$nomecampochiave="id",$tipo="numerico",$bordo=0,$backcolor="#ffffff",$fcolore="#000000",$nomecampo_allegati="",$backheader = "#ffffff",id="tabeldati")
   Cancella record da una tabella
   parametri
   $qry: query su tabella
   $nometabella: nome tabella della query
   $nomecampochiave: campo chiave primaria per la tabella
   $tipo: tipo del campo chiave numerico o testo
   $bordo: bordo tabella
   $backcolor: colore sfondo tabella
   $nomecampo_allegati: nome di un campo nella tabella che indica un percorso di file e quindi (il file che è associato viene cancellato)
   $backheader: colore sfondo intestazione
   $id = identificativo oggettp
  */
function canc_dati_tabella($qry,$nometabella,$nomecampochiave="id",$tipo="numerico",$bordo=0,$backcolor="#ffffff",$fcolore="#000000",$nomecampo_allegati="",$backheader = "#ffffff",$id="tabeldati")
{
 
 if (isset($_POST["valoreid"]))
  {
  	$qrycanc = (($tipo == "numerico") ? "delete from $nometabella where $nomecampochiave={$_POST["valoreid"]}":"delete from $nometabella where $nomecampochiave='{$_POST["valoreid"]}'");
	if ($nomecampo_allegati!="")
	  {
	    $qrysel = (($tipo == "numerico") ? "select $nomecampo_allegati from $nometabella where $nomecampochiave={$_POST["valoreid"]}":"select $nomecampo_allegati from $nometabella where $nomecampochiave='{$_POST["valoreid"]}'");
		$retsel = esegui_query($qrysel);
		$rigasel = getrecord($retsel);
                if (($rigasel[$nomecampo_allegati] != NULL) && ($rigasel[$nomecampo_allegati] != ""))
 		  unlink($rigasel[$nomecampo_allegati]);
	  }
  	esegui_query($qrycanc);
  }
 $resultqry = esegui_query($qry);
 if (numrec($resultqry) == 0)
 	echo "<b>Nessun record Trovato</b>";
 else
 {
 	$numcolonne = getnumcampi($resultqry);
	echo "<table style=\"border:solid {$bordo}px;background-color:$backcolor\" id=\"$id\">";
	echo "<tr>";
	for($i = 0;$i < $numcolonne;$i++)
	 {
		$nc = getnomecampo($resultqry,$i);
		echo "<th style=\"background-color:$backheader;border:solid {$bordo}px;\">$nc</th>";
	 }
	 echo "<th style=\"background-color:$backheader;border:solid {$bordo}px;\">Cancella</th>";
	 echo "</tr>";
	 while(($record = getrecord($resultqry)))
	  {
	    echo "<tr>";
	  	for($i = 0;$i < $numcolonne;$i++)
	     {
		   $nc = getnomecampo($resultqry,$i);
		   echo "<td style=\"text-align:left;border:solid {$bordo}px;color:{$fcolore};\">$record[$nc]</td>";
		   
		 }
		echo "<td style=\"text-align:left;border:solid {$bordo}px;color:{$fcolore};\">";
		form_crea("r" . $record[$nomecampochiave],1,"{$_SERVER["PHP_SELF"]}");
		echo "<div>";
		form_casella_testo_nascosta("valoreid",$record[$nomecampochiave]);
		form_invia("Cancella","submit");
		echo "</div>";
		
		echo "</td>";
		echo "</tr>";
		form_chiudi();
	  }
    echo "</table>";
 }
}	




/* funzione appoggio invia mail */


function legginomifile2($direttorio="./")
 {
	$d = opendir($direttorio);
	$nf= "";
	while($f = readdir($d))
	 if (($f != ".") && ($f != ".."))
		$nf .= $f . "|";
	return substr($nf,0,strlen($nf) -1);
 }



/*

Importante: è necessario che nello stesso direttorio si trovi il file allegafile.php e che venga creata una cartella allegatimail con permessi 777

$qry: query sql per selezionare gli indirizzi
$campomail: campo contenente l'indirizzo email - per default "email"
$campoid: campo chiave primaria della tabella  - per default "id"
$classe: classe fogli stile tabella default "mytable4"
$id: identificativo tabella default tabeldati
$autore: chi invia la mail default admin
$script_ritorno: script di ritorno "./menu.php" 
$tblautentica: tabella autenticazione per inviare email default "" che vuol dire senza autenticazione
nella tabella tblautentica ci deve essere il campo cansend = 1

esempio:

$con = connessione($hostmysql,$usermysql,$pwdmysql,$dbmysql);
invia_maildatabella("select id,cognome,nome,email from soci order by cognome,nome","email","id","mytable4","tabeldati","info@cittapossibile.com","./mailsoci.php?voceattiva=inviamail")

*/
function invia_maildatabella($qry,$campoemail="email",$campoid="id",$classe="mytable4",$id="tabeldati",$autore="admin",$script_ritorno="./menu.php",$tblautentica = "")
{
 
 if (isset($_POST["indirizzimail"]) && ($_POST["indirizzimail"] != ""))
  {
    if (isset($_POST["corpo"]))
	 {
	   if ($tblautentica != "")
	   {
	   	$q = esegui_query("select * from $tblautentica where username= '{$_POST["username"]}' and password = password('" . $_POST["password"] . "') and cansend = 1");
	   	$rec = getrecord($q);
	   	if($rec)
		{
	   		/* mail($_POST["indirizzimail"],$_POST["soggetto"],$_POST["corpo"],"From: $autore"); */
			$allegatom = str_array("|",legginomifile("./allegatimail/"));
			if(count($allegatom) > 0 && $allegatom[0] != "")
			{
				mymail($_POST["indirizzimail"],$autore,$_POST["soggetto"],$_POST["corpo"],"./allegatimail/" . $allegatom[0]);
				unlink("./allegatimail/" . $allegatom[0]);
			}
			else
				mail($_POST["indirizzimail"],$_POST["soggetto"],$_POST["corpo"],"From: $autore");
		  
		}
	   	else
		{
			myalert("Utente non autorizzato",$script_ritorno);
			exit;
		}
	  
		
	   }
	   else
	   {
			$allegatom = str_array("|",legginomifile("./allegatimail/"));
			if(count($allegatom) > 0 && $allegatom[0] != "")
			{
				mymail($_POST["indirizzimail"],$autore,$_POST["soggetto"],$_POST["corpo"],"./allegatimail/" . $allegatom[0]);
				unlink("./allegatimail/" . $allegatom[0]);
			}
			else
				mail($_POST["indirizzimail"],$_POST["soggetto"],$_POST["corpo"],"From: $autore");
			
	   }
	   unset($_POST["indirizzimail"]);
	   echo "<script language=\"javascript\" type=\"text/javascript\">document.location.href=\"$script_ritorno\"</script>";

	 }
     else
	{
	 $vindirizzimail = "";
	 if(isset($_POST["broadcast"]) && ($_POST["broadcast"] == 1))
		{
	 		$resultqry = esegui_query($qry);
			while(($record = getrecord($resultqry)))
				if(!empty($record["email"]))
					$vindirizzimail .= $record["email"] . ",";	
		}
	 else
		{
	 		while(list($key,$valore) = each($_POST))
	 		{
	    			/* if (ereg("^mailto",$key)) */ 
				if (strpos("mailto",$key) === 0) 
		 			$vindirizzimail .= $valore . ",";
	 		}
		}
	 $vindirizzimail = substr($vindirizzimail,0,strlen($vindirizzimail) -1);
         if(isset($tblautentica) && ($tblautentica != ""))
	 {
	 	echo "<p>&nbsp;</p><p class=centratobold>Questa funzionalit&agrave; &egrave; riservata solo ad alcuni utenti</p>";
	 }
	 form_crea("mail",1,"{$_SERVER["PHP_SELF"]}");
	 echo "Specificare l'oggetto della MAIL<br />";  
	 form_casella_testo("soggetto",$valore="",50,50,"stile3");
	 echo "<br /><br />Digitare il testo della mail<br />";  
	 form_textarea("corpo","",8,50,"stile4");
	 echo "<br /><a title=\"allega file\" class=semplice4 href=\"#\" onclick=\"window.open('./allegafile.php', 'Allegato','toolbar=no,menubar=no,scrollbars=yes,top=10,left=5,height=500,width=750');\">Inserisci allegato</a><br />";
	 if (isset($tblautentica) && ($tblautentica != ""))
	 {  
	 	echo "<br />Autenticarsi per inviare<br />";  
	 	form_casella_testo("username",$valore="",30,30);
	 	echo "<br />password<br />";  
	 	form_password("password",$valore="",30,30);
	 }
	 form_casella_testo_nascosta("indirizzimail",$vindirizzimail);
	 echo "<br />";
	 form_invia("Spedisci","submit1");
	 form_chiudi();
	}
	
  }
 else
  {
   $resultqry = esegui_query($qry);
   if (numrec($resultqry) == 0)
 	 echo "<b>Nessun record Trovato</b>";
   else
   {
   	 $numcolonne = getnumcampi($resultqry);
	 
	 form_crea("selezionaindirizzi",1,"{$_SERVER["PHP_SELF"]}");
	 echo "<table class=\"$classe\">";
	 $numcolonne1 = $numcolonne;
	 echo "<tr><th class=\"centrato\" colspan=\"$numcolonne1\">";
	 form_invia("Invia MAIL agli utenti selezionati");
	 echo "</th></tr>";
	 
	 echo "<tr><th class=\"centrato\" colspan=\"$numcolonne1\">Se questa e-mail &egrave; per tutti spuntare solo questa casella&nbsp;";
	 echo "<input type=\"checkbox\" name=\"broadcast\" value=\"1\" /></th></tr>";
	 echo "<tr>";
	 for($i = 0;$i < $numcolonne;$i++)
	  {
		 $nc = getnomecampo($resultqry,$i);
		if ($nc != "id")
		 echo "<th>$nc</th>";
	  }
	  echo "<th>Includi</th>";
	  echo "</tr>";
	  while(($record = getrecord($resultqry)))
	   {
	    echo "<tr>";
	  	for($i = 0;$i < $numcolonne;$i++)
	     {
		   $nc = getnomecampo($resultqry,$i);
		   if ($nc != "id")
			if($nc != $campoemail)
		   		echo "<td>$record[$nc]</td>";
			else
				echo "<td><a title=\"invia mail\" href=\"mailto:$record[$nc]\">$record[$nc]</a></td>";
		   
	     }
		echo "<td class=\"centrato\">";
		echo "<input type=\"checkbox\" name=\"mailto" . $record[$campoid] . "\" value=\"$record[$campoemail]\" />";
		echo "</td>";
		echo "</tr>";
	   }
	   echo "<tr><td colspan=\"$numcolonne1\">";
	   form_casella_testo_nascosta("indirizzimail","completati");
	   echo "</td></tr>";
	   echo "</table>";
	    form_chiudi();
	}
 }
}




/*
modtabella_dati($qry,$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$nometabella="utenti",$campok="id",$tipok="numerico",$scriptmodifica="./modutenti.php")
Crea una vista dei dati sotto forma di tabela
Parametri
$qry: query su tabella
$bordo: bordo tabella
$backcolor: colore sfondo tabella
$backheader: colore sfondo intestazione
$id = identificativo oggettp
$nometabella: nome tabella di riferimento
$campok: nome campo chiave
$tipok: tipologia della chiave numerico o testo
$scriptmodifica: script per la registrazione dei dati (bisogna prevedere solo il salvataggio vale a dire delle update )
*/
function modtabella_dati($qry,$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$nometabella="utenti",$campok="id",$tipok="numerico",$scriptmodifica="./modutenti.php")
{
 
 if (isset($_POST["submit1"]))
  {
    unset($_POST["submit1"]);
    $qrydet = (($tipok == "numerico") ? "select * from $nometabella where $campok={$_POST["valoreid"]}":"select * from $nometabella where $campok='{$_POST["valoreid"]}'");	
    $resultqry1 = esegui_query($qrydet);	
    $rec = getrecord($resultqry1);
    $ncampi = getnumcampi($resultqry1);
    $strget .= "<form method=\"post\" action=\"$scriptmodifica\"><table>";
    
    for($i = 0;$i < $ncampi;$i++)
     {
	    $chiave =  getnomecampo($resultqry1,$i);  
	    $valore =  $rec[$chiave];
	    $valore = ereg_replace(" ","&nbsp;",$valore);
	    $strget .= "<tr><td><b>$chiave</b></td><td>";
  	    $strget .=  "<input type=\"text\" name=\"{$chiave}\"  size=\"50\" maxlength=\"50\"  value=\"{$valore}\" />";
	    $strget .=  "<input type=\"hidden\" name=\"old{$chiave}\"  size=\"50\" maxlength=\"50\"  value=\"{$valore}\" />";

            $strget .=  "</td></tr>";
	      
     }
	$strget .= "<tr><td colspan=\"2\" style=\"text-align:center\"><input type=\"submit\" value=\"Salva modifiche\" /></td></tr>";
        $strget .=  "<tr><td>&nbsp;</td></tr><tr><td colspan=\"2\" style=\"text-align:center\"><a href=\"#\" style=\"background-color:#000000;color:#ffffff;text-decoration:none\" onclick=\"window.close()\">&nbsp;CHIUDI&nbsp;</a></td></tr></table>";
	
	echo "<script language=\"javascript\" type=\"text/javascript\">";
	echo "wnd = window.open('','Modifica_dati','toolbar=no,menubar=no,top=20,left=40,height=650,width=650');";
	echo "wnd.document.write('$strget');";
	echo "</script>";	
  }
  $resultqry = esegui_query($qry);
  if (numrec($resultqry) == 0)
 	echo "<b>Nessun record Trovato</b>";
  else
  {
 	$numcolonne = getnumcampi($resultqry);
	echo "<table cellpadding=\"0\" cellspacing=\"2\" style=\"border:solid {$bordo}px;background-color:$backcolor\" id=\"$id\">";
	echo "<tr>";
	for($i = 0;$i < $numcolonne;$i++)
	 {
		$nc = getnomecampo($resultqry,$i);
		echo "<th style=\"border:solid {$bordo}px;background-color:$backheader\">$nc</th>";
	 }
	 echo "<th style=\"border:solid #ffffff {$bordo}px;background-color:$backheader\">Dettagli</th>";
	 echo "</tr>";
	 while(($record = getrecord($resultqry)))
	  {
	    echo "<tr>";
	  	for($i = 0;$i < $numcolonne;$i++)
	     {
		   $nc = getnomecampo($resultqry,$i);
		   echo "<td style=\"border:solid {$bordo}px;background-color:$backcolor\">$record[$nc]</td>";
		   
	     }
		 echo "<td style=\"border:solid {$bordo}px;background-color:$backcolor;text-align:center\">";
		 
		 form_crea("r" . $record[$campok],1,"{$_SERVER["PHP_SELF"]}");
		 
		 form_casella_testo_nascosta("valoreid",$record[$campok]);
		 form_invia("Modifica","submit1");
		 echo "</td>";
		 echo "</tr>";
		 form_chiudi();
		 
		 
		 
		 
	
	  }
    echo "</table>";
    
  }
}





/*
creatabella_dati_dett($qry,$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$qry2)
Crea una vista dei dati sotto forma di tabela
Parametri
$qry: query su tabella
$bordo: bordo tabella
$backcolor: colore sfondo tabella
$backheader: colore sfondo intestazione
$id = identificativo oggetto tabella
$nometabella: nome tabella dettagli
$campok: nome campo chiave
$campok1: nome campo chiave esterna dei dettagli
$tipok: tipologia della chiave "numerico" o "testo"
*/
function creatabella_dati_dett($qry,$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$nometabella="utenti",$campok="id",$campok1 = "id",$tipok="numerico")
{
 
 if (isset($_POST["submit1"]))
  {
    	unset($_POST["submit1"]);
	$qrydet = (($tipok == "numerico") ? "select * from $nometabella where $campok1={$_POST["valoreid"]}":"select * from $nometabella where $campok1='{$_POST["valoreid"]}'");	
	$resultqry1 = esegui_query($qrydet);	
	$ncampi = getnumcampi($resultqry1);
	echo "<script language=\"javascript\" type=\"text/javascript\">";	
	echo "wnd = window.open('','Dettagli','toolbar=no,menubar=no,top=20,left=40,height=500,width=700');";
	echo "wnd.document.write('<h3 style=\"text-align:center\">Dettagli</h3>');";
	echo "wnd.document.write('<div style=\"margin:0px auto;padding:0px;text-align:center\">');";
	
	echo "wnd.document.write('<table style=\"background-color:#339999;text-align:center;border:0\">');";
	echo "wnd.document.write('<tr>');";
	for($i = 0;$i < $ncampi;$i++)
	 	{
	   		$nomec = getnomecampo($resultqry1,$i);
	   		echo "wnd.document.write('<th style=\"background-color:#99ffcc;text-align:right\">$nomec</th>');";
	 	}
	echo "wnd.document.write('</tr>');";
	while($rec = getrecord($resultqry1))
	{
		echo "wnd.document.write('<tr>');";
		for($i = 0;$i < $ncampi;$i++)
	 	{
	   		$nomec = getnomecampo($resultqry1,$i);
	   		echo "wnd.document.write('<td style=\"background-color:#ccccff\">$rec[$nomec]</td>');";
	 	}
		echo "wnd.document.write('</tr>');";
	}
	 echo "wnd.document.write('</table>');";
	 echo "wnd.document.write('</div>');";
	 echo "wnd.document.write('<p style=\"text-align:center\"><input type=button value=Chiudi onclick=\"window.close();\"></p>');";
	echo "</script>";
  }
 if (!isset($_POST["oldquery"]))
 	$resultqry = esegui_query($qry);
 else
	{
		$resultqry = esegui_query(stripslashes($_POST["oldquery"]));
		$qry = stripslashes($_POST["oldquery"]);
	}
	
	
 if (numrec($resultqry) == 0)
 	echo "<b>Nessun record Trovato</b>";
 else
 {
 	$numcolonne = getnumcampi($resultqry);
	echo "<table cellpadding=\"0\" cellspacing=\"2\" style=\"border:solid {$bordo}px;background-color:$backcolor\" id=\"$id\">";
	echo "<tr>";
	for($i = 0;$i < $numcolonne;$i++)
	 {
		$nc = getnomecampo($resultqry,$i);
		echo "<th style=\"background-color:$backheader;border:solid {$bordo}px;\">$nc</th>";
	 }
	 echo "<th style=\"background-color:$backheader;border:solid {$bordo}px;\">Dettagli</th>";
	 echo "</tr>";
	 while(($record = getrecord($resultqry)))
	  {
	    echo "<tr>";
	  	for($i = 0;$i < $numcolonne;$i++)
	     {
		   $nc = getnomecampo($resultqry,$i);
		   echo "<td style=\"text-align:left;border:solid {$bordo}px;\">$record[$nc]" .  "&nbsp;" . "</td>";
		   
	     }
		 echo "<td style=\"text-align:center;border:solid {$bordo}px;\">";
		 form_crea("r" . $record[$campok],1,$_SERVER["HTTP_REFERER"]);
		 echo "<div>";
		 form_casella_testo_nascosta("valoreid",$record[$campok]);
		 form_casella_testo_nascosta("oldquery","$qry",255,255);
		 form_invia("Dettagli","submit1");
		 echo "</div>";
		 form_chiudi();
		 echo "</td>";
		 echo "</tr>";
		 
	  }
    echo "</table>";
 }
}	
	
?>
