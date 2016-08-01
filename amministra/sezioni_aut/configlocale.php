<?php
$dirsito = $_SERVER["DOCUMENT_ROOT"] . "/siti/asl/";
$areaaut = "admin";

$tabella = "sezioni_aut";

/* campi da visualizzare in fase di inserimento  - chiave/valore */

$campi_tabella = array("Identificativo sezione" => "idsezaut","Descrizione sezione"=>"Descrizione");


$tipo_campi_tabella = array("idsezaut" => "s","Descrizione" => "s");			   

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
   
$campi_tabella_righe = array("Sezione" => "idsezaut","Descrizione" => "Descrizione");

$campo_chiave = "idsezaut";
$tipo_chiave = "s"; /* s per stringhe - d per date - n per numeri */


$campi_ricerca = array("Sezione" => "idsezaut","Descrizione" => "Descrizione");
$campi_ricerca_tipo = array("idsezaut" => "s","Descrizione" => "s"); /* s per stringhe - d per date - n per numeri */
$orderby = "Descrizione";

$max_num_rec_vis = 5;

$campi_obbligatori_ins_upd = array("idsezaut","Descrizione");
$campi_unici_tabella = array("idsezaut");
$tipo_campi_unici_tabella = array("s");

$titolopg = "Aree autorizzazioni";



?>