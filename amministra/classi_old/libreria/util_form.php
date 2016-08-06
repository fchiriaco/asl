<?
/* funzione che crea il tag form 
Descrizione parametri:
$nome: nome del form
$post_get: 1 metodo post, 0 metodo get
$script: azione
$valid: funzione javascript per validare input 
*/
function form_crea($nome,$post_get,$script,$valid="")
{
  $tagstr = "<form id=\"$nome\"";
  if ($post_get == 1)
   $tagstr .= " method=\"post\"";
  else
   $tagstr .= " method=\"get\"";
  if(isset($valid) && $valid != "")
	$tagstr .= " onsubmit=\"return {$valid};\"";
  $tagstr .= " action=\"$script\">";
  echo $tagstr;
}


/* funzione che crea il tag form multipart enctype
Descrizione parametri:
$nome: nome del form
$post_get: 1 metodo post, 0 metodo get
$script: azione
$valid: funzione javascript per validare input
*/
function form_crea_multipart($nome,$post_get,$script,$valid="")
{
  $tagstr = "<form id=\"$nome\"";
  if ($post_get == 1)
   $tagstr .= " method=\"post\"";
  else
   $tagstr .= " method=\"get\"";
  if(isset($valid) && $valid != "")
	$tagstr .= " onsubmit=\"return {$valid};\"";
  $tagstr .= " enctype=\"multipart/form-data\" action=\"$script\">";
  echo $tagstr;
}

function form_chiudi()
 {
  echo "</form>";
 }

 function form_casella_testo($nome,$valore="",$size=30,$maxlen=30,$classe="")
  {
    $tag = "<input type=\"text\" " ;
	if ($classe != "")
		$tag .= "class=\"$classe\" ";
	$tag .= "name=\"$nome\" id=\"$nome\" value=\"$valore\" size=\"$size\" maxlength=\"$maxlen\" />";
	echo $tag;
  }

 function form_casella_testo_nascosta($nome,$valore="",$size=30,$maxlen=30)
  {
    echo "<input type=\"hidden\" name=\"$nome\" value=\"$valore\" size=\"$size\" maxlength=\"$maxlen\" />";
  }
 
 
 function form_file($nome="userfile",$valore="",$size=100,$maxlen=100,$classe = "")
  {
    if(empty($classe))
   	 echo "<input type=\"file\" name=\"$nome\" value=\"$valore\" size=\"$size\" maxlength=\"$maxlen\" />";
    else
	echo "<input type=\"file\" name=\"$nome\" value=\"$valore\" size=\"$size\" maxlength=\"$maxlen\" class=\"$classe\" />";

  }
  
 function form_invia($valore="Invia",$nome="submit",$azione="",$classe="")
 {
		$tag = "<input type=\"submit\" ";
   		if ($azione != "")
   				$tag .= "onclick=\"$azione\" ";
		if(empty($classe)) 
   			$tag .= "name=\"$nome\" value=\"$valore\" />";
		else
			$tag .= "name=\"$nome\" value=\"$valore\" class=\"$classe\" />";

   echo $tag;
 }
 
function form_check($nome,$valore="",$classe="")
 {
  if (empty($classe))
  	echo "<input type=\"checkbox\" name=\"$nome\" id=\"$nome\" value=\"$valore\" />";
  else
	echo "<input type=\"checkbox\" name=\"$nome\" id=\"$nome\" value=\"$valore\" class=\"$classe\" />";


 }

 

 function form_password($nome="password",$size=30,$maxlen=30,$classe="")
 {
 	if ($classe != "")
    		echo "<input class=\"$classe\" type=password name=\"$nome\" id=\"$nome\" size=\"$size\" maxlength=\"$maxlen\" />";
	else
		echo "<input type=password name=\"$nome\" id=\"$nome\" size=\"$size\" maxlength=\"$maxlen\" />";
  }
  
 function form_select($arvoci,$nomeselect,$arvalori = "",$classe="",$voceselezionata = "",$multi=0)
    {
	  if ($arvalori == "")
	  	$arvalori = $arvoci;
      	  if ($classe != "")
		if($multi == 1)
			echo "<select class=\"$classe\" name=\"{$nomeselect}[]\"  MULTIPLE>\n" ;
		else
      	  		echo "<select class=\"$classe\" name=\"$nomeselect\" id=\"$nomeselect\">\n" ;
	  else
		if($multi == 1)
			echo "<select name=\"{$nomeselect}[]\"  MULTIPLE>\n" ;
		else
			echo "<select name=\"$nomeselect\" id=\"$nomeselect\">\n" ;
	  for($i = 0;$i < count($arvoci);$i++)
	   {
		if (($arvalori[$i] == $voceselezionata) && ($voceselezionata != ""))
	   		echo	"<option SELECTED value=\"{$arvalori[$i]}\">{$arvoci[$i]}</option>\n";
		else
			echo	"<option value=\"{$arvalori[$i]}\">{$arvoci[$i]}</option>\n";
	   }
	  echo "</select>" ;
	}
 
 function form_select_qry($qry,$nomeselect="",$classe="")
    {
	  $ris = esegui_query($qry);
	  $numrec = numrec($ris);
	  if(empty($classe))
	  	echo "<select name=\"$nomeselect\" id=\"$nomeselect\">" ;
	  else
		echo "<select name=\"$nomeselect\" id=\"$nomeselect\" class=\"$classe\">" ;

	  for($i = 0;$i < $numrec;$i++)
	   {
	        $riga=getrecord($ris);
			$indice = getnomecampo($ris,0);
	   		echo	"<option value=\"{$riga[$indice]}\">{$riga[$indice]}</option>";
	   }
	  echo "</select>" ;
	}
	

 function form_select_qry2($qry,$nomeselect="",$numcampov = 0,$numcampod = 0,$classe="",$opzioneattiva = "")
    {
	  $ris = esegui_query($qry);
	  $numrec = numrec($ris);
	  if ($classe != "")
	  	echo "<select class=\"$classe\" name=\"$nomeselect\" id=\"$nomeselect\">" ;
	  else
	  	echo "<select name=\"$nomeselect\" id=\"$nomeselect\">" ;
	  echo	"<option value=\"\">Seleziona</option>";
	  for($i = 0;$i < $numrec;$i++)
	   {
	        $riga=getrecord($ris);
		$indicev = getnomecampo($ris,$numcampov);
		$indiced = getnomecampo($ris,$numcampod);
		if ($opzioneattiva == $riga[$indicev])
		  echo	"<option value=\"{$riga[$indicev]}\" SELECTED>{$riga[$indiced]}</option>";
		else
		  echo	"<option value=\"{$riga[$indicev]}\">{$riga[$indiced]}</option>";
	   }
	  echo "</select>" ;
   }





 function form_textarea($name,$valore = "",$righe = 3, $colonne = 80,$classe="")
  {
      $tag = "<textarea name=\"$name\" id=\"$name\" rows=\"$righe\" cols=\"$colonne\" ";
	  if ($classe != "")
	  	$tag .= "class=\"$classe\" ";
	  $tag .= ">$valore</textarea>";
	  echo $tag;
  }


/* 

funzione per creare una form generica
autore: Francesco Chiriaco
data: 31-03-2007
nome funzione: form_generica
parametri:
	$campi: array con la seguente struttura   array(tipo,valore,lunghezza,nome,etichetta)
			  se si tratta di una select valore deve essere un array("chiave","valore");
			  se si tratta  di una textarea valore deve essere array(valore,righe,colonne)
	$nomeform: nome della form
	$intestazione: intestazione del modulo
	$campi_per_riga: numero di campi per riga, se vale 1 occorre scrivere in una colonna l'etichetta e nell'altra il campo
	$azione: action della form
	$classe_tabella_form: classe della tabella sfondo della form
	$classe_input: classe caselle form
	$metodo: metodo post o get per default 1 0 = get
	$script_validazione: eventuale script javascript per validare l'input dell'utente

esempio utilizzo


$campi[] = array("tipo" => "select","valore" => $classi,"lunghezza" => 30,"nome" => "classi","etichetta" => "Adottato per le classi","multi" => 1);
$campi[] = array("tipo" => "select","valore" => $materie,"lunghezza" => 30,"nome" => "idmateria","etichetta" => "Materia");
$campi[] = array("tipo" => "text","valore" => "","lunghezza" => 70,"nome" => "titolo","etichetta" => "Titolo");
$campi[] = array("tipo" => "text","valore" => "","lunghezza" => 70,"nome" => "autori","etichetta" => "Autori");
$campi[] = array("tipo" => "text","valore" => "","lunghezza" => 70,"nome" => "editore","etichetta" => "Editore");
$campi[] = array("tipo" => "text","valore" => 0,"lunghezza" => 6,"nome" => "prezzo","etichetta" => "Prezzo euro");
$campi[] = array("tipo" => "text","valore" => "","lunghezza" => 70,"nome" => "note","etichetta" => "Altre Informazioni");
$campi[] = array("tipo" => "submit","valore" => "Conferma","lunghezza" => 20,"nome" => "submit","etichetta" => "");
form_generica($campi,"libri","Inserimento libri da vendere",$_SERVER["PHP_SELF"],"semplice3","stile3",1,1,"");
*/

function form_generica($campi,$nomeform,$intestazione,$azione,$classe_tabella_form="semplice3",$classe_input="stile3",$campi_per_riga=1,$metodo=1,$script_validazione="")
{
echo "<div style=\"text-align:center;margin:0px 0px;padding:0px 0px;\">\n";
echo "<h3 style=\"text-align:center;font-size:1.2em;\">$intestazione</h3>\n";
form_crea_multipart($nomeform,$metodo,$azione,$script_validazione);
echo "\n<table class=\"{$classe_tabella_form}\">\n";
$campo_riga = 0;
for($i = 0;$i < count($campi);$i++)
 {
		if((($campo_riga % $campi_per_riga) == 0))
		{
			if ($campi_per_riga > 1)
			{
				if (($campi[$i]["tipo"] != "submit"))
					echo "\n<tr>\n";
				for ($j=$i;$j < $i + $campi_per_riga ;$j++)
					if (isset($campi[$j + 1]) && ($campi[$j + 1]["tipo"] != "submit"))
						{
							if (($campi[$j]["tipo"] != "submit"))
								echo "<th><label for=\"{$campi[$i]["nome"]}\">" . $campi[$j]["etichetta"] . "</label></th>\n";
							else
								$j = $i + $campi_per_riga;
						}
						
						
					else
						{
							if (($campi[$j]["tipo"] != "submit"))
								echo "<th colspan=\"" .  ($i + $campi_per_riga - $j) .   "\"><label for=\"{$campi[$i]["nome"]}\">{$campi[$j]["etichetta"]}</label></th>\n";
							
							$j = $i + $campi_per_riga;
						}
	
				
				if (($campi[$i]["tipo"] != "submit"))
					echo "</tr>\n<tr>\n";
				
			}
			else
				if (($campi[$i]["tipo"] != "submit"))
					echo "\n<tr>\n<th><label for=\"{$campi[$i]["nome"]}\">" . $campi[$i]["etichetta"] . "</label></th>\n";
				
				
				
					
					
		}

		
		

		if(($campi[$i]["tipo"] != "submit"))
		{
			if (($campi[$i]["tipo"] == "text") || ($campi[$i]["tipo"] == "file") || ($campi[$i]["tipo"] == "password"))
				$paggiuntivi = " size=\"{$campi[$i]["lunghezza"]}\" maxlength=\"{$campi[$i]["lunghezza"]}\" ";
			else
				$paggiuntivi = "";
			if(isset($campi[$i]["sololettura"]) && ($campi[$i]["sololettura"] == true) )
				$paggiuntivi .= " disabled=\"disabled\" ";
			if($campi[$i]["tipo"] == "textarea")
			{
				if(($campi[$i + 1]["tipo"] != "submit"))
				{
					echo "<td>";
					echo "<textarea name=\"{$campi[$i]["nome"]}\" id=\"{$campi[$i]["nome"]}\" rows=\"{$campi[$i]["valore"][1]}\" cols=\"{$campi[$i]["valore"][2]}\">";
					echo $campi[$i]["valore"][0];
					echo "</textarea>";
					echo "</td>";
				}
				else
				{
					echo "<td colspan=\"" . ($campi_per_riga - $campo_riga) . "\">";
					echo "<textarea name=\"{$campi[$i]["nome"]}\" id=\"{$campi[$i]["nome"]}\"  rows=\"{$campi[$i]["valore"][1]}\" cols=\"{$campi[$i]["valore"][2]}\">";
					echo $campi[$i]["valore"][0];
					echo "</textarea>";
					echo "</td>";
				}
			}
			else
			{	

				if(($campi[$i]["tipo"] != "select"))
					if(($campi[$i + 1]["tipo"] != "submit"))
						echo "<td><input type=\"{$campi[$i]["tipo"]}\" name=\"{$campi[$i]["nome"]}\" id=\"{$campi[$i]["nome"]}\" value=\"{$campi[$i]["valore"]}\" class=\"" . ((isset($campi[$i]["classe"]) && ($campi[$i]["classe"] != "")) ? $campi[$i]["classe"]:$classe_input) . "\" {$paggiuntivi} /></td>";
					else
						echo "<td colspan=\"" . ($campi_per_riga - $campo_riga) . "\"><input type=\"{$campi[$i]["tipo"]}\" name=\"{$campi[$i]["nome"]}\" id=\"{$campi[$i]["nome"]}\" value=\"{$campi[$i]["valore"]}\" class=\""  . ((isset($campi[$i]["classe"]) && ($campi[$i]["classe"] != "")) ? $campi[$i]["classe"]:$classe_input) .  "\" {$paggiuntivi}  /></td>";
				
				else
					{	unset($ke);
						unset($va);
						foreach($campi[$i]["valore"] as $k => $v)
						{
							$ke[] = $k;
							$va[] = $v;
						}
				
						if(($campi[$i + 1]["tipo"] != "submit"))
							echo "<td>\n"; 
						else
							echo "<td colspan=\"" . ($campi_per_riga - $campo_riga) ."\">\n";
						if($campi[$i]["multi"] == 1)
 							form_select($ke,$campi[$i]["nome"],$va,((isset($campi[$i]["classe"]) && ($campi[$i]["classe"] != "")) ? $campi[$i]["classe"]:$classe_input),"",1);
						else
							form_select($ke,$campi[$i]["nome"],$va,((isset($campi[$i]["classe"]) && ($campi[$i]["classe"] != "")) ? $campi[$i]["classe"]:$classe_input));
							
						echo "\n</td>\n";
					}
			}
						
			$campo_riga++;
			if(($campo_riga % $campi_per_riga) == 0)
			{
				if (($campi[$i]["tipo"] != "submit"))
					echo "</tr>\n";
				$campo_riga = 0;
			}
			
			
			
		}
		else
		{
				if ($campi_per_riga != 1)
					echo "<tr><td style=\"text-align:center;\" colspan=\"{$campi_per_riga}\">";
				else
					echo "<tr><td colspan=\"2\" style=\"text-align:center;\">";
	
				form_invia($campi[$i]["valore"],$campi[$i]["nome"],"",((isset($campi[$i]["classe"]) && ($campi[$i]["classe"] != "")) ? $campi[$i]["classe"]:$classe_input));
				echo "</td></tr>\n";
				$campo_riga = 0;

		}
			

		

		
	
 }
if(($campo_riga % $campi_per_riga) != 0)
	echo "</tr>\n";
echo "</table>\n";
form_chiudi();
echo "\n</div>";
}
	
?>