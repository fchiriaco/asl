<?php session_start(); ?>

<?php
		
	include("configlocale.php");
	include("{$dirsito}config.php");
	include($dirsito ."libreria/util_func2.php");
	include($dirsito . "libreria/util_dbnew.php");
	$con = connessione(HOST,USER,PWD,DBNAME);
?>
<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="utf-8">
	<title><?php echo $pagetitle ?></title>

  <!-- META -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- META -->
  
  <!-- CSS -->
  <link type="text/css" href="<?php echo $dirsitoscript; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link type="text/css" href="<?php echo $dirsitoscript; ?>css/stile.css" rel="stylesheet" media="screen">
  <!-- CSS -->  
  
</head>
<body>
   <!-- CONTENUTO DELLA PAGINA ... -->
   <div class="container-fluid">
		<div class="row bg-info">
			<div class="col-xs-12 col-sm-6 col-lg-4 logo text-center">
				<?php include("{$dirsito}logo.php"); ?>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-offset-6 col-lg-2 text-right">
				<div id="panreg">
					<?php include($dirsito . "autentica/utreg.php");?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12" style="padding:0px;">
				<?php include($dirsito . "navbar.php"); ?>
			</div>
		</div>
		
   </div>
  <!-- JS -->
  <script src="<?php echo $dirsitoscript; ?>js/jquery-1.11.3.min.js"></script>
  <script src="<?php echo $dirsitoscript; ?>bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo $dirsitoscript; ?>autentica/scriptaut.js"></script>
  <!-- JS -->
</body>
</html>
