<?php
$dirsito = $_SERVER["DOCUMENT_ROOT"] . "/siti/asl/";
$areaaut = "admin";

$tabella = "aziende";

/* campi da visualizzare in fase di inserimento  - chiave/valore */

$campi_tabella = array("Ragione sociale" => "denominazione",
					   "Indirizzo" => "indirizzo","Attiv. Econ. ATECO" => "attecateco",
					   "Rappr. Legale" => "rapprlegale","Cod. Fiscale" => "codfisc","Telefono" => "telefono",
					   "E-Mail" =>"email","Sito web" => "web");
					   

/* campi da visualizzare sotto forma di tabella - chiave/valore */
   
$campi_tabella_righe = array("Ragione sociale" => "denominazione",
					   "Indirizzo" => "indirizzo","Rappr. Legale" => "rapprlegale",
					   "Cod. Fiscale" => "codfisc","Telefono" => "telefono",
					   "E-Mail" =>"email"
					   );

$campo_chiave = "id";
$tipo_chiave = "n"; /* s per stringhe - d per date - n per numeri */


$campi_ricerca = array("Ragione sociale" => "denominazione","Cod. Fiscale" => "codfisc");
$campi_ricerca_tipo = array("denominazione" => "s","codfisc" => "s"); /* s per stringhe - d per date - n per numeri */
$orderby = "denominazione";

$max_num_rec_vis = 5;
$titolopg = "AZIENDE";


?>