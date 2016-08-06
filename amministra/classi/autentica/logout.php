<? 
session_start();
header('Expires: Wed, 23 Dec 1980 00:30:00 GMT');
header('Last Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache Control: no-cache, must-revalidate');
header('Pragma: no-cache');
session_destroy();
$stringa = "<table style=\"margin:1px auto 0px auto;\">";
$stringa .= "<tr>";
$stringa .= "<td style=\"text-align:right;\">utente:&nbsp; </td><td><input class=\"form-control\"  type=\"text\" value=\"\" id=\"utregn\" name=\"utregn\" /></td>";
$stringa .= "</tr>";
$stringa .= "<tr>";
$stringa .= "<td style=\"text-align:right;\">password:&nbsp; </td><td><input class=\"form-control\"  type=\"password\" value=\"\" id=\"utregp\" name=\"utregp\" /></td>";
$stringa .= "</tr>";
$stringa .= "<tr><td>&nbsp;</td><td style=\"text-align:center;\"><input class=\"btn btn-xs btn-primary\" type=\"button\" value=\" Accedi \" id=\"subm\" name=\"subm\" onclick=\"autenticaajax();return false;\" /></td></tr>";
$stringa .= "</table>";
echo $stringa;
?>
