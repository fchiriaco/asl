<? 
if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1))
{
	
?>
<table  style="margin:5px auto 5px auto;">
<tr>
<td style="text-align:right;font-size:0.85em;height:26px;padding:2px;">utente: </td><td><input class="form-control input-sm" type="text" value="" id="utregn" name="utregn" /></td>
</tr>
<tr>
<td style="text-align:right;font-size:0.85em;height:26px;padding:2px;">password: </td><td><input class="form-control input-sm" type="password" value="" id="utregp" name="utregp" /></td>
</tr>
<tr><td>&nbsp;</td><td style="text-align:center;height:26px;"><input class="btn btn-primary btn-xs btn-block" type="button" value=" Accedi " id="subm" name="subm" /></td></tr>
</table>
<?
} 
else
{
	$query = "select * from utenti where id = {$_SESSION["idut"]}";
	$rsu = esegui_query($con,$query);
	$ru = getrecord($rsu);
	$stringa =  "<p style=\"font-size:0.85em;\">Utente: {$ru["username"]}<br /><a style=\"color:#000000;font-weight:bold;\" title=\"Cambio password\" href=\"cambiopwd2/index.php\">-Cambio password</a><br /><a style=\"color:#000000;font-weight:bold;\" title=\"Chiudi sessione\" href=\"#\" onclick=\"logout()\";>-Chiudi sessione</a></p>";
	echo $stringa;
	
}
?>
