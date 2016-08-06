<?
include("util_html.php");
aprihtml();
apriheader("Allega File","./stile.css");
include("./config.php"); 
include("./util_db.php"); 
include("./util_form.php");
include("./util_func2.php");

function estensione($nomefile)
{
	$ar = explode(".",$nomefile);
	$lung = count($ar);
	return $ar[$lung - 1];
}


chiudiheader();
?>

<div class=centro>
<?
if(!isset($_POST["submit"]))
{
	echo "<p>&nbsp;</p>";
	echo "<p>&nbsp;</p>";
	form_crea_multipart("allegatomail",1,$_SERVER["PHP_SELF"]);
	echo "<label for=\"userfile\">File Allegato</label><br />";
	form_file();
	echo "<br /><br />";
	form_invia("Conferma allegato");
	form_chiudi();
	echo "<p class=centrato>";
	echo "<a class=semplice4 title \"Chiudi\" href=\"#\" onclick=\"window.close();\">&nbsp;Torna alla Mail&nbsp;</a>";
	echo "</p>";
}
else
{
	unset($_POST["submit"]);
	if(isset($_FILES['userfile']['name']))
	{
		$destfile = upload_file2("./allegatimail");
		echo "<p class=centratobold>Allegato inserito con successo</p>";
		echo "<p class=centrato>";
		echo "<a class=semplice4 title \"Chiudi\" href=\"#\" onclick=\"window.close();\">&nbsp;Torna alla Mail&nbsp;</a>";
		echo "</p>";
	}
	
}
?>
</div>
<?
chiudihtml();
?>
