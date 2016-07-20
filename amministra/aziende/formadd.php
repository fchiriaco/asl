<form role="form" id="frmadd" method="post">
<?php
$stringaadd = "";
foreach($campi_tabella as $k => $v)
{
	$stringaadd .= '<div class="form-group" style="padding:5px;">';
	$stringaadd .= '<label for="add-' . $v . '">' . $k . ':</label>';
	$stringaadd .= ' <input type="text" class="form-control" id="add-' . $v .  '" name="add-' . $v . '">';
	$stringaadd .= "</div>";
}
$stringaadd .= '<p class="text-center"><button id="salvanew" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> SALVA RECORD</button> ';
$stringaadd .=  '<button id="rinuncia" type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> ANNULLA</button></p>';
echo $stringaadd;
?>


</form>