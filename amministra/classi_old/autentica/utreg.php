<? 
if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1)) 
{
	
?>
<table style="margin:1px auto 0px auto;">
<tr>
<td style="text-align:right;">utente:&nbsp; </td><td><input class="form-control"  type="text" value="" id="utregn" name="utregn" /></td>
</tr>
<tr>
<td style="text-align:right;">password:&nbsp; </td><td><input class="form-control"  type="password" value="" id="utregp" name="utregp" /></td>
</tr>
<tr><td>&nbsp;</td><td style="text-align:center;"><input class="btn btn-xs btn-primary" type="button" value=" Accedi " id="subm" name="subm" onclick="autenticaajax();return false;" /></td></tr>
</table>
<?
} 
else
{
	$query = "select * from utenti where id = {$_SESSION["idut"]}";
	$rsu = esegui_query($con,$query);
	$ru = getrecord($rsu);
	echo "<p>Utente autenticato: {$ru["username"]}<br /><a style=\"color:#000000;font-weight:bold;\" title=\"Cambio password\" href=\"cambiopwd2/index.php\">-Cambio password</a><br /><a style=\"color:#000000;font-weight:bold;\" title=\"Chiudi sessione\" href=\"#\" onclick=\"logout();return false;\">-Chiudi sessione</a></p>";
	
}
?>
