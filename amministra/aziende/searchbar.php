
<?php

	if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],$areaaut) === false) || !isset($_SESSION["amministratore"][$areaaut]) || ($_SESSION["amministratore"][$areaaut] != 1))
	{
	
		myalert("Utente non autorizzato","{$dirsitoscript}index.php");
		exit;
	}
	
	$stringa = '';
	$stringa .= '<div class="ricerca bg-info">';
	$stringa .= '<form role="form" id="formsearch" class="form-inline">';
	foreach($campi_ricerca as $k => $v)
	{
		$stringa .= '<div class="form-group" style="padding:5px;">';
		$stringa .= '<label for="' . $v . '">' . $k . ':</label>';
		$stringa .= ' <input type="text" class="form-control" id="' . $v .  '" name="' . $v . '">';
		$stringa .= "</div>";
	}
	
	$stringa .= '<div class="form-group" style="padding:5px;">';
	$stringa .= '<label for="recvisualizzati">Righe da visualizzare:</label>';
	$stringa .= ' <input type="text" class="form-control" id="recvisualizzati" name="recvisualizzati"  value="' . $max_num_rec_vis . '">';
	$stringa .= '<input id="recstart" name="recstart" type="hidden" value="0">';
	$stringa .= "</div>";
	
	$stringa .= '<button type="submit" id="sendricerca" name="sendricerca" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-search"></span> CERCA</button>';
	$stringa .= '</form>';
	$stringa .= '</div>';
	echo $stringa;
?>