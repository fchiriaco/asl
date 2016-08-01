<?php
$dirsito = $_SERVER["DOCUMENT_ROOT"] . "/siti/asl/";
$areaaut = "admin";

$tabella = "materie";

/* campi da visualizzare in fase di inserimento  - chiave/valore */

$campi_tabella = array("Materia" => "materia");


$tipo_campi_tabella = array("materia" => "s");			   

/* questa parte gestisce la creazione di un account utente associato ad ogni riga della tabella */
$crea_account = 0;
if($crea_account == 1)
{
	$campi_account = array("Nome Utente" => "username","Password" => "password");
	$tipo_campi_account = array("username" => "s","password" => "p"); /* p sta per password */
	$tabella_utenti = "utenti";
	$campo_nome_utente = "username";
	$tabella_aree_autorizzazione = "aree_aut";
	$aree_autorizzate = array("aziende");
	$livello = array(0);
	$campo_chiave_utenti = "id";
	$tipo_chiave_utenti = "n";
	/* chiave esterna su tabella principale collegata a campo chiave utenti */
	$chiave_esterna_utente = "idutente";
	$tipo_chiave_esterna = "n";
}

					   


/* campi da visualizzare sotto forma di tabella - chiave/valore */
   
$campi_tabella_righe = array("Materia" => "materia");

$campo_chiave = "id";
$tipo_chiave = "n"; /* s per stringhe - d per date - n per numeri */


$campi_ricerca = array("Materia" => "materia");
$campi_ricerca_tipo = array("materia" => "s"); /* s per stringhe - d per date - n per numeri */
$orderby = "materia";

$max_num_rec_vis = 5;

$campi_obbligatori_ins_upd = array("materia");
$campi_unici_tabella = array("materia");
$tipo_campi_unici_tabella = array("s");

$titolopg = "MATERIE INSEGNATE";



?>