<?php
$dirsito = $_SERVER["DOCUMENT_ROOT"] . "/siti/asl/";

$areaaut = "admin";

$tabparent = "sedi";
$tabparent2 = "docenti";

$tabchild = "classi";

$ordine = array("tabparent"=>"nome_sede","tabchild" =>"indirizzo,anno_classe","tabparent2" => "cognome,nome");

$campiid = array("tabparent"=>"id","tabchild" =>"id","tabparent2"=>"id");

$campo_chiave_esterna_child = "idsede";
$campo_chiave_esterna_child2 = "idcoordinatore";



$campiparent = array("id","nome_sede","indirizzo","telefono","email","responsabile");
$campiparentdesc = array("Id","Sede","Indirizzo","Telefono","Email","Responsabile");

$campiparent2 = array("id","cognome","nome");
$campiparentdesc2 = array("Id","Coordinatore");

$campichild = array("id","nome_classe","indirizzo_studio","anno_classe","idsede","idcoordinatore");
$campichilddesc = array("Id","Classe","Indirizzo studio","Anno classe","Sede","Coordinatore");



$titolo = "Classi Istituto";

$testoaddrecchild = "Inserisci nuova classe";

$testoaddrecparent = "Salva Sede";

$testobtnrinuncia = "Annulla inserimento";

$paginaindice = "../../index.php";
?>
