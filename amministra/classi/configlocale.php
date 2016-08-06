<?php
$dirsito = $_SERVER["DOCUMENT_ROOT"] . "/siti/asl/";

$areaaut = "admin";

$tabparent = "sedi";

$tabchild = "classi";

$ordine = array("tabparent"=>"nome_sede","tabchild" =>"indirizzo,anno_classe");

$campiid = array("tabparent"=>"id","tabchild" =>"id");

$campo_chiave_esterna_child = "idsede";

$campiparent = array("id","nome_sede","indirizzo","telefono","email","responsabile");
$campiparentdesc = array("Id","Sede","Indirizzo","Telefono","Email","Responsabile");

$campichild = array("id","nome_classe","indirizzo_studio","anno_classe","idsede");
$campichilddesc = array("Id","Classe","Indirizzo studio","Anno classe","Id sede");


$titolo = "Classi Istituto";

$testoaddrecchild = "Inserisci nuova classe";

$testoaddrecparent = "Salva Sede";

$testobtnrinuncia = "Annulla inserimento";

$paginaindice = "../../index.php";
?>
