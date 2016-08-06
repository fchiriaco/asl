<? 
if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1)) 
{
	
?>
<table style="margin:1px auto 0px auto;">
<tr>
<td style="text-align:right;font-size:0.85em;">utente: </td><td><input class="form-control"  type="text" value="" id="utregnm" name="utregnm" /></td>
</tr>
<tr>
<td style="text-align:right;font-size:0.85em;">password: </td><td><input class="form-control"  type="password" value="" id="utregpm" name="utregpm" /></td>
</tr>
<tr><td>&nbsp;</td><td style="text-align:center;"><input class="btn btn-xs btn-primary" type="button" value=" Accedi " id="submm" name="submm" onclick="autenticaajaxmobile();return false;" /></td></tr>
</table>
<?
} 
else
{
	$query = "select * from utenti where id = {$_SESSION["idut"]}";
	$rsu = esegui_query($con,$query);
	$ru = getrecord($rsu);
	echo "<p>Utente autenticato: {$ru["username"]}<br /><a style=\"color:#000000;font-weight:bold;\" title=\"Cambio password\" href=\"../cambiopwd2/index.php\">-Cambio password</a><br /><a style=\"color:#000000;font-weight:bold;\" title=\"Chiudi sessione\" href=\"#\" onclick=\"logoutmobile();return false;\">-Chiudi sessione</a></p>";
	
}
?>
