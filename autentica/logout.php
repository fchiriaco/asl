<? 
session_start();
header('Expires: Wed, 23 Dec 1980 00:30:00 GMT');
header('Last Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache Control: no-cache, must-revalidate');
header('Pragma: no-cache');
session_destroy();
$stringa = "<table style=\"margin:5px auto 5px auto;\">";
$stringa .= "<tr>";
$stringa .= "<td style=\"text-align:right;font-size:0.85em;height:26px;padding:2px;\">utente: </td><td><input class=\"form-control input-sm\" type=\"text\" value=\"\" id=\"utregn\" name=\"utregn\" /></td>";
$stringa .= "</tr>";
$stringa .= "<tr>";
$stringa .= "<td style=\"text-align:right;font-size:0.85em;height:26px;padding:2px;\">password: </td><td><input class=\"form-control input-sm\" type=\"password\" value=\"\" id=\"utregp\" name=\"utregp\" /></td>";
$stringa .= "</tr>";
$stringa .= "<tr><td>&nbsp;</td><td style=\"text-align:center;height:26px;\"><input class=\"btn btn-primary btn-xs btn-block\" type=\"button\" value=\" Accedi \" id=\"subm\" name=\"subm\" /></td></tr>";
$stringa .= "</table>";
echo $stringa;
?>
