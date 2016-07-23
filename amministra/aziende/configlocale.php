<?php
$dirsito = $_SERVER["DOCUMENT_ROOT"] . "/siti/asl/";
$areaaut = "admin";

$tabella = "aziende";

/* campi da visualizzare in fase di inserimento  - chiave/valore */

$campi_tabella = array("Ragione sociale" => "denominazione",
					   "Indirizzo" => "indirizzo","Attiv. Econ. ATECO" => "attecateco",
					   "Rappr. Legale" => "rapprlegale","Cod. Fiscale" => "codfisc","Telefono" => "telefono",
					   "E-Mail" =>"email","Sito web" => "web");

					   
$tipo_campi_tabella = array("denominazione" => "s","indirizzo" => "s",
							"attecateco" => "s","rapprlegale" => "s","codfisc" => "s","telefono" => "s",
							"email" => "s","web" => "s");

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

$campi_obbligatori_ins_upd = array("denominazione");
$campi_unici_tabella = array("denominazione","codfisc");
$tipo_campi_unici_tabella = array("s","s");

$titolopg = "AZIENDE";


?>