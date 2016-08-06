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
	echo "<script language=javascript>";	
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
		 form_crea("r" . $record[$campok],1,$_SERVER["PHP_SELF"]);
		 echo "<div>";
		 form_casella_testo_nascosta("valoreid",$record[$campok]);
		 form_invia("Dettagli","submit1");
		 echo "</div>";
		 form_chiudi();
		 echo "</td>";
		 echo "</tr>";
		 
	  }
    echo "</table>";
 }
}

/* funzione canc_dati_tabella($qry,$nometabella,$nomecampochiave="id",$tipo="numerico",$bordo=0,$backcolor="#ffffff",$nomecampo_allegati="",$backheader = "#ffffff",id="tabeldati")
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
function canc_dati_tabella($qry,$nometabella,$nomecampochiave="id",$tipo="numerico",$bordo=0,$backcolor="#ffffff",$nomecampo_allegati="",$backheader = "#ffffff",$id="tabeldati")
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
		   echo "<td style=\"text-align:left;border:solid {$bordo}px;\">$record[$nc]</td>";
		   
		 }
		echo "<td style=\"text-align:left;border:solid {$bordo}px;\">";
		form_crea("r" . $record[$nomecampochiave],1,"{$_SERVER["PHP_SELF"]}");
		echo "<div>";
		form_casella_testo_nascosta("valoreid",$record[$nomecampochiave]);
		form_invia("Cancella","submit");
		echo "</div>";
		form_chiudi();
		echo "</td>";
		echo "</tr>";
	  }
    echo "</table>";
 }
}	

/* funzione invia_maildatabella($qry,$campoemail="email",$campoid="id",$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$autore="admin",$script_ritorno="menu.php")
   Crea una tabella con utenti a cui inviare mail
   parametri
   $qry: query su tabella
   $campomail: nome del campo che contiene la mail
   $campoid: campo chiave primaria per la tabella
   $bordo: bordo tabella
   $backcolor: colore sfondo tabella
   $backheader: colore sfondo intestazione
   $id = identificativo oggetto
   $autore: username dell'autore email
   $script_ritorno: script o file dove ritornare dopo che si è inviata la mail
  */
  
function invia_maildatabella($qry,$campoemail="email",$campoid="id",$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$autore="admin",$script_ritorno="./menu.php")
{
 global $indirizzimail,$corpo,$soggetto,$PHP_SELF,$HTTP_POST_VARS; 
 if (isset($indirizzimail) & ($indirizzimail != ""))
  {
    if (isset($corpo))
	 {
	   mail($indirizzimail,$soggetto,$corpo,"From: $autore");
	   $indirizzimail = "";
	   echo "<script language=javascript>document.location.href=\"$script_ritorno\"</script>";

	 }
     else
	{
	 $indirizzimail = "";
	 while(list($key,$valore) = each($HTTP_POST_VARS))
	 {
	    if (ereg("^mailto",$key))
		 $indirizzimail .= $valore . ",";
	 }
	 $indirizzimail = substr($indirizzimail,0,strlen($indirizzimail) -1);
	 form_crea("mail",1,"$PHP_SELF");
	 echo "Specificare l'oggetto della MAIL<br />";  
	 form_casella_testo("soggetto",$valore="",50,50);
	 echo "<br />Testo MAIL<br />";  
	 form_textarea("corpo",$valore = "",$righe = 10,80);
	 form_casella_testo_nascosta("indirizzimail",$indirizzimail);
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
	 
	 form_crea("selezionaindirizzi",1,"$PHP_SELF");
	 echo "<table border=$bordo bgcolor=$backcolor id=$id>";
	 $numcolonne1 = $numcolonne+1;
	 echo "<tr><th colspan=$numcolonne1 bgcolor=$backheader>";
	 form_invia("Invia MAIL agli utenti selezionati");
	 echo "</th></tr>";
	 echo "<tr>";
	 for($i = 0;$i < $numcolonne;$i++)
	  {
		 $nc = getnomecampo($resultqry,$i);
		 echo "<th bgcolor=$backheader>$nc</th>";
	  }
	  echo "<th bgcolor=$backheader>Includi</th>";
	  echo "</tr>";
	  while(($record = getrecord($resultqry)))
	   {
	    echo "<tr>";
	  	for($i = 0;$i < $numcolonne;$i++)
	     {
		   $nc = getnomecampo($resultqry,$i);
		   echo "<td valign=top NOWRAP>$record[$nc]</td>";
		   
		 }
		echo "<td align=center valign=top NOWRAP>";
		echo "<input type=checkbox name=mailto" . $record[$campoid] . " value=$record[$campoemail]>";
		echo "</td>";
		echo "</tr>";
	   }
	   form_casella_testo_nascosta("indirizzimail","completati");
	   form_chiudi();
      echo "</table>";
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
$scriptmodifica: script per la registrazione dei dati
*/
function modtabella_dati($qry,$bordo=0,$backcolor="#ffffff",$backheader = "#ffffff",$id="tabeldati",$nometabella="utenti",$campok="id",$tipok="numerico",$scriptmodifica="./modutenti.php")
{
 global $submit1, $valoreid,$PHP_SELF;
 if (isset($submit1))
  {
    unset($submit1);
    $qrydet = (($tipok == "numerico") ? "select * from $nometabella where $campok=$valoreid":"select * from $nometabella where $campok='$valoreid'");	
    $resultqry1 = esegui_query($qrydet);	
    $rec = getrecord($resultqry1);
    $ncampi = getnumcampi($resultqry1);
    $strget = "";
    for($i = 0;$i < $ncampi;$i++)
     {
	    $chiave =  getnomecampo($resultqry1,$i);  
	    $valore =  $rec[$chiave];
	    $valore = ereg_replace(" ","&nbsp;",$valore);
	    $strget .= "<tr><td><b>$chiave</b></td><td>";
  	    $strget .=  "<input class=inputstyle type=text name=$chiave  size=50 maxlength=50 onchange=cambia_sfondo(this,1) value=$valore>";
            $strget .=  "</td></tr>";
		 
     }
	echo "<script language=javascript>";
	echo "wnd = window.open(\"$scriptmodifica?rec=$strget&submit2=ok&nometabella=$nometabella&campoid=$campok&tipoid=$tipok\",'Modifica_dati','toolbar=no,menubar=no,top=20,left=40,height=450,width=500');";
	echo "</script>";	
  }
  $resultqry = esegui_query($qry);
  if (numrec($resultqry) == 0)
 	echo "<b>Nessun record Trovato</b>";
  else
  {
 	$numcolonne = getnumcampi($resultqry);
	echo "<table cellpadding=0 cellspacing=2 border=$bordo bgcolor=$backcolor id=$id>";
	echo "<tr>";
	for($i = 0;$i < $numcolonne;$i++)
	 {
		$nc = getnomecampo($resultqry,$i);
		echo "<th bgcolor=$backheader>$nc</th>";
	 }
	 echo "<th bgcolor=$backheader>Dettagli</th>";
	 echo "</tr>";
	 while(($record = getrecord($resultqry)))
	  {
	    echo "<tr>";
	  	for($i = 0;$i < $numcolonne;$i++)
	     {
		   $nc = getnomecampo($resultqry,$i);
		   echo "<td valign=top>$record[$nc]</td>";
		   
	     }
		 echo "<td valign=top align=center>";
		 form_crea("r" + $record[$campok],1,"$PHP_SELF");
		 form_casella_testo_nascosta("valoreid",$record[$campok]);
		 form_invia("Modifica","submit1");
		 form_chiudi();
		 echo "</td>";
		 echo "</tr>";
	
	  }
    echo "</table>";
  }
}

/* funzione crea_form_input($record,$script) permette di creare un form per modificare i dati di una tabella 
parametri:
$record: campi del form tipo text <input .......><input.....> passati come stringa
$script: lo script per salvare i dati
*/
function crea_form_input($record,$script)
{
?>
  <head>
<?
  include("config.php");
  echo "<link rel=stylesheet type=text/css href=\"$fogliostile\">";
?>
  <script language=javascript>
  function cambia_sfondo(el,focus_o_blur)
  {
   if (focus_o_blur == 1)
    {
     el.style.fontfamily = "Arial";
     el.style.background="#99ccff";
 
    }
   else
    {
     el.style.fontfamily = "Arial";
     el.style.background="#f0f0f0";
 
    }
  }
  </script>
  </head>
 <?
 echo "<h3 align=center>Modifica Dati</h3>";
 form_crea("datainput",1,$script);
 echo "<table id=dataentry bgcolor=#daab59 align=center>";
 echo $record;
 echo "<tr><td colspan=2 align=center>";
 form_invia("salva","salva");
 echo "</td></tr>";
 echo "</table>";
 form_chiudi();	
}

/* 
funzione crea_form_input2($arcampi,$arcampi2,$arcampi3,$script) permette di creare un form per modificare i dati di una tabella 
parametri:
$arcampi: array associativo, nome campo , valore
$arcampi2: array associativo, nome campo , tipo elemento form
$arcampi3: array associativo nomecampo dimensione campo form
$script: lo script per salvare i dati
$bottone_submit: nome del bottone submit
$intestazione: dicitura intestazione
*/

function crea_form_input2($arcampi,$arcampi2,$arcampi3,$script,$bottone_submit ="salva",$intestazione="Inserimento nuovo record",$arcampi4="")
{
?>
  <head>
<?
  include("config.php");
  echo "<link rel=stylesheet type=text/css href=\"$fogliostile\">";
?>
  <script language=javascript>
  function cambia_sfondo(el,focus_o_blur)
  {
   if (focus_o_blur == 1)
    {
     el.style.fontfamily = "Arial";
     el.style.background="#99ccff";
 
    }
   else
    {
     el.style.fontfamily = "Arial";
     el.style.background="#f0f0f0";
 
    }
  }
  </script>
  </head>
 <?
 echo "<h3 align=center>$intestazione</h3>";
 form_crea("datainput",1,$script);
 echo "<table id=dataentry bgcolor=#daab59 align=center>";
 $primavoceselect = true;
 while(list($key,$value) = each($arcampi))
 {
  if ($arcampi2[$key] == "select")
   {
  	 echo "<tr><td><b>" . (($arcampi4 == "") ? "$key:" : $arcampi4[$key]) . "</b></td><td><select name=$key onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">";
	  for($i = 0;$i < count($arcampi[$key]);$i++)
	   if ($primavoceselect == true)
	    {
	     echo "<option selected>" . $arcampi[$key][$i] . "</option>";
		 $primavoceselect = false;
		}
	   else echo "<option>" . $arcampi[$key][$i] . "</option>";
	 echo "</select></td></tr>";
   }
   if ($arcampi2[$key] == "textarea")
    {
		echo "<tr><td><b>" . (($arcampi4 == "") ? "$key:" : $arcampi4[$key]) . "</b></td><td><textarea name=$key rows=4 cols=65  onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">$arcampi[$key]";
		echo "</textarea></td></tr>";
	}
	if (($arcampi2[$key] == "hidden"))
	  echo "<tr><td><b>&nbsp;</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";
	if (($arcampi2[$key] != "textarea") & ($arcampi2[$key] != "select") & ($arcampi2[$key] !="hidden"))
	 echo "<tr><td><b>" . (($arcampi4 == "") ? "$key:" : $arcampi4[$key]) . "</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";

 }
 echo "<tr><td colspan=2 align=center>";
 form_invia($bottone_submit,$bottone_submit);
 echo "</td></tr>";
 echo "</table>";
 form_chiudi();	
}


/* 
funzione crea_form_input3($arcampi,$arcampi2,$arcampi3,$script) permette di creare un form multipart per modificare i dati di una tabella 
parametri:
$arcampi: array associativo, nome campo , valore
$arcampi2: array associativo, nome campo , tipo elemento form
$arcampi2: array associativo nomecampo dimensione campo form
$script: lo script per salvare i dati
$bottone_submit: nome del bottone submit
$intestazione: dicitura intestazione
*/

function crea_form_input3($arcampi,$arcampi2,$arcampi3,$script,$bottone_submit ="salva",$intestazione="Inserimento nuovo record",$arcampi4="")
{
?>
  <head>
<?
  include("config.php");
  echo "<link rel=stylesheet type=text/css href=\"$fogliostile\">";
?>
  <script language=javascript>
  function cambia_sfondo(el,focus_o_blur)
  {
   if (focus_o_blur == 1)
    {
     el.style.fontfamily = "Arial";
     el.style.background="#99ccff";
 
    }
   else
    {
     el.style.fontfamily = "Arial";
     el.style.background="#f0f0f0";
 
    }
  }
  </script>
  </head>
 <?
 echo "<h3 align=center>$intestazione</h3>";
 form_crea_multipart("datainput",1,$script);

 echo "<table id=dataentry bgcolor=#daab59 align=center>";
 $primavoceselect = true;
 while(list($key,$value) = each($arcampi))
 {
  if ($arcampi2[$key] == "select")
   {
  	 echo "<tr><td><b>" . (($arcampi4 == "") ? "$key:" : $arcampi4[$key]) . "</b></td><td><select name=$key onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">";
	  for($i = 0;$i < count($arcampi[$key]);$i++)
	   if ($primavoceselect == true)
	    {
	     echo "<option selected>" . $arcampi[$key][$i] . "</option>";
		 $primavoceselect = false;
		}
	   else echo "<option>" . $arcampi[$key][$i] . "</option>";
	 echo "</select></td></tr>";
   }
   if ($arcampi2[$key] == "textarea")
    {
		echo "<tr><td><b>" . (($arcampi4 == "") ? "$key:" : $arcampi4[$key]) . "</b></td><td><textarea name=$key rows=4 cols=65  onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">$arcampi[$key]";
		echo "</textarea></td></tr>";
	}
	if (($arcampi2[$key] == "hidden"))
	  echo "<tr><td><b>&nbsp;</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";
	if (($arcampi2[$key] != "textarea") & ($arcampi2[$key] != "select") & ($arcampi2[$key] !="hidden"))
	 echo "<tr><td><b>" . (($arcampi4 == "") ? "$key:" : $arcampi4[$key]) . "</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";

 }
 echo "<tr><td colspan=2 align=center>";
 form_invia($bottone_submit,$bottone_submit);
 echo "</td></tr>";
 echo "</table>";
 form_chiudi();	
}




/* 
funzione crea_form_input4($arcampi,$arcampi2,$arcampi3,$script,$arcampi4,$arcampi5) permette di creare un form per modificare i dati di una tabella 
parametri:
$arcampi: array associativo, nome campo , valore
$arcampi2: array associativo, nome campo , tipo elemento form
$arcampi3: array associativo nomecampo dimensione campo form
$script: lo script per salvare i dati
$bottone_submit: nome del bottone submit
$intestazione: dicitura intestazione
$arcampi4: intestazione campi (ciò che verrà scritto davanti alla casella di immissione dati)
$arcampi5: se il campo è una select e sarà diverso da "" il vero valore che deve essere immesso (value della select)
*/

function crea_form_input4($arcampi,$arcampi2,$arcampi3,$script,$bottone_submit ="salva",$intestazione="Inserimento nuovo record",$arcampi4="",$arcampi5="")
{
?>
  <head>
<?
  include("config.php");
  echo "<link rel=stylesheet type=text/css href=\"$fogliostile\">";
?>
  <script language=javascript>
  function cambia_sfondo(el,focus_o_blur)
  {
   if (focus_o_blur == 1)
    {
     el.style.fontfamily = "Arial";
     el.style.background="#99ccff";
 
    }
   else
    {
     el.style.fontfamily = "Arial";
     el.style.background="#f0f0f0";
 
    }
  }
  </script>
  </head>
 <?
 echo "<h3 align=center>$intestazione</h3>";
 form_crea("datainput",1,$script);
 echo "<table id=dataentry bgcolor=#daab59 align=center>";
 $primavoceselect = true;
 while(list($key,$value) = each($arcampi))
 {
  if ($arcampi2[$key] == "select")
   {
  	 echo "<tr><td><b>" . ((!isset($arcampi4[$key])) ? "$key:" : $arcampi4[$key]) . "</b></td><td><select name=$key onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">";
	  for($i = 0;$i < count($arcampi[$key]);$i++)
	   if ($primavoceselect == true)
	    {
	         if (!isset($arcampi5[$key]))
	          echo "<option selected>" . $arcampi[$key][$i] . "</option>";
		 else
		  echo "<option value=\"" . $arcampi5[$key][$i] . "\"  selected>" . $arcampi[$key][$i] . "</option>";
		 $primavoceselect = false;
		}
	   else 
	    if (!isset($arcampi5[$key]))
	          echo "<option>" . $arcampi[$key][$i] . "</option>";
  	    else
		  echo "<option value=\"" . $arcampi5[$key][$i] . "\">" . $arcampi[$key][$i] . "</option>";
	 echo "</select></td></tr>";
   }
   if ($arcampi2[$key] == "textarea")
    {
		echo "<tr><td><b>" . ((!isset($arcampi4[$key])) ? "$key:" : $arcampi4[$key]) . "</b></td><td><textarea name=$key rows=4 cols=65  onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">$arcampi[$key]";
		echo "</textarea></td></tr>";
	}
	if (($arcampi2[$key] == "hidden"))
	  echo "<tr><td><b>&nbsp;</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";
	if (($arcampi2[$key] != "textarea") & ($arcampi2[$key] != "select") & ($arcampi2[$key] !="hidden"))
	 echo "<tr><td><b>" . ((!isset($arcampi4[$key])) ? "$key:" : $arcampi4[$key]) . "</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";

 }
 echo "<tr><td colspan=2 align=center>";
 form_invia($bottone_submit,$bottone_submit);
 echo "</td></tr>";
 echo "</table>";
 form_chiudi();	
}




/* 
funzione crea_form_input5($arcampi,$arcampi2,$arcampi3,$script,$bottone_submit ="salva",$intestazione="Inserimento nuovo record",$arcampi4="",$arcampi5="") permette di creare un form per modificare i dati di una tabella il form è multipart/fotm-data
parametri:
$arcampi: array associativo, nome campo , valore
$arcampi2: array associativo, nome campo , tipo elemento form
$arcampi3: array associativo nomecampo dimensione campo form
$script: lo script per salvare i dati
$bottone_submit: nome del bottone submit
$intestazione: dicitura intestazione
$arcampi4: intestazione campi (ciò che verrà scritto davanti alla casella di immissione dati)
$arcampi5: se il campo è una select e sarà diverso da "" il vero valore che deve essere immesso (value della select)
*/

function crea_form_input5($arcampi,$arcampi2,$arcampi3,$script,$bottone_submit ="salva",$intestazione="Inserimento nuovo record",$arcampi4="",$arcampi5="")
{
?>
<head>
<?
  include("config.php");
  echo "<link rel=stylesheet type=text/css href=\"$fogliostile\">";
?>
  <script language=javascript>
  function cambia_sfondo(el,focus_o_blur)
  {
   if (focus_o_blur == 1)
    {
     el.style.fontfamily = "Arial";
     el.style.background="#99ccff";
 
    }
   else
    {
     el.style.fontfamily = "Arial";
     el.style.background="#f0f0f0";
 
    }
  }
  </script>
  </head>
 <?
 echo "<h3 align=center>$intestazione</h3>";
 form_crea_multipart("datainput",1,$script);
 echo "<table id=dataentry bgcolor=#daab59 align=center>";
 $primavoceselect = true;
 while(list($key,$value) = each($arcampi))
 {
  if ($arcampi2[$key] == "select")
   {
  	 echo "<tr><td><b>" . ((!isset($arcampi4[$key])) ? "$key:" : $arcampi4[$key]) . "</b></td><td><select name=$key onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">";
	  for($i = 0;$i < count($arcampi[$key]);$i++)
	   if ($primavoceselect == true)
	    {
	         if (!isset($arcampi5[$key]))
	          echo "<option selected>" . $arcampi[$key][$i] . "</option>";
		 else
		  echo "<option value=\"" . $arcampi5[$key][$i] . "\"  selected>" . $arcampi[$key][$i] . "</option>";
		 $primavoceselect = false;
		}
	   else 
	    if (!isset($arcampi5[$key]))
	          echo "<option>" . $arcampi[$key][$i] . "</option>";
  	    else
		  echo "<option value=\"" . $arcampi5[$key][$i] . "\">" . $arcampi[$key][$i] . "</option>";
	 echo "</select></td></tr>";
   }
   if ($arcampi2[$key] == "textarea")
    {
		echo "<tr><td><b>" . ((!isset($arcampi4[$key])) ? "$key:" : $arcampi4[$key]) . "</b></td><td><textarea name=$key rows=4 cols=65  onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\">$arcampi[$key]";
		echo "</textarea></td></tr>";
	}
	if (($arcampi2[$key] == "hidden"))
	  echo "<tr><td><b>&nbsp;</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";
	if (($arcampi2[$key] != "textarea") & ($arcampi2[$key] != "select") & ($arcampi2[$key] !="hidden"))
	 echo "<tr><td><b>" . ((!isset($arcampi4[$key])) ? "$key:" : $arcampi4[$key]) . "</b></td><td><input type=$arcampi2[$key] name=$key size=$arcampi3[$key] maxlength=$arcampi3[$key] onfocus=\"cambia_sfondo(this,1)\"  onblur=\"cambia_sfondo(this,2)\"  value=\"$arcampi[$key]\"></td></tr>";

 }
 echo "<tr><td colspan=2 align=center>";
 form_invia($bottone_submit,$bottone_submit);
 echo "</td></tr>";
 echo "</table>";
 form_chiudi();	
}
?>