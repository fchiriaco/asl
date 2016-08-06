<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>

<?php 
include("configlocale.php");
include("{$dirsito}config.php");
include("{$dirsito}libreria/util_dbnew.php");
include("{$dirsito}libreria/util_func2.php");


if(!isset($_SESSION["aut"]) || ($_SESSION["aut"] != 1) || !isset($_SESSION["area"]) || (strpos($_SESSION["area"],$areaaut) === false) || !isset($_SESSION["amministratore"][$areaaut]) || ($_SESSION["amministratore"][$areaaut] != 1))
{
	
	myalert("Utente non autorizzato",$paginaindice);
	exit;
}



$con = connessione(HOST,USER,PWD,DBNAME);

/* opzioni elenco laboratori */
$sql = "select * from {$tabparent} order by {$ordine["tabparent"]}";

$rs = esegui_query($con,$sql);
$elenco = "<option value=\"0\">Seleziona da elenco</option>";
while($r = getrecord($rs))
{
		$elenco .= "<option value=\"{$r[$campiid["tabparent"]]}\">{$r[$campiparent[1]]}</option>";
}
$elenco .= "<option value=\"-1\">Aggiungi nuovo record</option>";


?>
 <title><?php echo $titolo ?></title>


  <!-- META -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- META -->
  
  <!-- CSS -->
  <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" media="screen">
  <link type="text/css" href="<?php echo $dirsitoscript; ?>css/stile.css" rel="stylesheet" media="screen">
  <link href="css/stile.css" rel="stylesheet" type="text/css" media="screen">
  <link href="css/nuovocss.css" rel="stylesheet" type="text/css" media="screen">
  <!-- CSS --> 
  
    
</head>
<body>
<!-- CONTENUTO DELLA PAGINA ... -->	
<div class="container-fluid" id="contenitore">
	
	<div class="row bg-info">
		<div class="col-xs-12 col-sm-6 col-lg-4 logo text-center">
			<?php include("{$dirsito}logo.php"); ?>
		</div>
	</div>	
	<div class="row">
		<div class="col-xs-12">
			<?php include($dirsito . "navbar.php"); ?>
				
		</div>
	</div>

	
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12"><div class="alert alert-info text-center h3" style="margin-top:0px;"><?php echo $titolo ?></div></div>
	</div>
	
	<div class="row">
	 <div class="col-xs-12 col-md-12 col-lg-12 text-center">
		<div id="upload" style="text-align:left;padding-left:3px;padding-top:3px;">
		<form  id="salvaform" name="salva" method="POST">
		<table style="margin:10px auto;">
		<tr id="rigaselectparent">
		<th><label for="<?php echo $campiparent[1] ?>"><?php echo $campiparentdesc[1] ?> </label></th><td><select id="<?php echo $campiparent[1] ?>" name="<?php echo $campiparent[1] ?>" class="form-control"><?php echo $elenco; ?></select></td>
		</tr>
		<tr id="campoparent1">
		<th><label for="campo1parent"><?php echo $campiparentdesc[1] ?> </label></th><td><input class="form-control" type="text" id="campo1parent" name="campo1parent"></td>
		</tr>
		<tr>
		<th><label for="<?php echo $campiparent[2] ?>"><?php echo $campiparentdesc[2] ?> </label></th><td><input class="form-control" type="text" id="<?php echo $campiparent[2] ?>" name="<?php echo $campiparent[2] ?>"></td>
		</tr>
		<tr>
		<th><label for="<?php echo $campiparent[3] ?>"><?php echo $campiparentdesc[3] ?> </label></th><td><input class="form-control" type="text" id="<?php echo $campiparent[3] ?>" name="<?php echo $campiparent[3] ?>"></td>
		</tr>
		<tr>
		<th><label for="<?php echo $campiparent[4] ?>"><?php echo $campiparentdesc[4] ?> </label></th><td><input class="form-control" type="text" id="<?php echo $campiparent[4] ?>" name="<?php echo $campiparent[4] ?>"></td>
		</tr>
		<tr>
		<th><label for="<?php echo $campiparent[5] ?>"><?php echo $campiparentdesc[5] ?> </label></th><td><input class="form-control" type="text" id="<?php echo $campiparent[5] ?>" name="<?php echo $campiparent[5] ?>"></td>
		</tr>
				<tr>
		<td colspan="2" style="padding-top:10px;text-align:center;"><button class="btn btn-default btn-success btn-xs" id="salva"><?php echo $testoaddrecchild ?></button></td>
		</tr>
		<tr id="rigasalvaparent">
		<td style="padding:10px;text-align:center;width:50%"><button class="btn btn-default btn-success btn-xs btn-block" id="salvaparent"><?php echo $testoaddrecparent ?></button></td><td style="padding:10px;text-align:center;width:50%"><button class="btn btn-default btn-success btn-xs btn-block" id="rinuncia"><?php echo $testobtnrinuncia; ?></button></td>
		</tr>
		</table>
		</form>
		
		</div>	
	 </div>
   </div>
	
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12" id="elenco">
			
		
		</div>
	</div>
	
</div>
  <!-- CONTENUTO DELLA PAGINA ... -->
<!-- JS -->
  
  <script src="bootstrap/js/jquery-1.10.2.min.js"></script>
  <script src="bootstrap/js/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="javascript/script.js"></script>
  <!-- JS -->
 
</body>
</html>
