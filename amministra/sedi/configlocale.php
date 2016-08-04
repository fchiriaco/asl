<?php
$dirsito = $_SERVER["DOCUMENT_ROOT"] . "/siti/asl/";
$areaaut = "admin";

$tabella = "sedi";

/* campi da visualizzare in fase di inserimento  - chiave/valore */

$campi_tabella = array("Sede" => "nome_sede","Indirizzo" => "indirizzo","Telefono" => "telefono","E-Mail" => "email","Responsabile" => "responsabile");


$tipo_campi_tabella = array("nome_sede" => "s","indirizzo" => "s","telefono" => "s","email" => "s","responsabile" => "s");			   

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
   
$campi_tabella_righe = array("Sede" => "nome_sede","Telefono" => "telefono","E-mail" => "email","Responsabile" => "responsabile");

$campo_chiave = "id";
$tipo_chiave = "n"; /* s per stringhe - d per date - n per numeri */


$campi_ricerca = array("Sede" => "nome_sede");
$campi_ricerca_tipo = array("nome_sede" => "s");  /* s per stringhe - d per date - n per numeri */
$orderby = "nome_sede";

$max_num_rec_vis = 5;

$campi_obbligatori_ins_upd = array("nome_sede");
$campi_unici_tabella = array("nome_sede");
$tipo_campi_unici_tabella = array("s");

$titolopg = "SEDI ISTITUTO";



?>