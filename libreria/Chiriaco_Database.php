<?php
/* classe Database_Mysql creata da Francesco Chiriaco il 26-01-2015 
interfaccia pubblica:

$objdb->query_select($sql) - esegue una query di tipo select
$objdb->query_aggiornamento($sql) - esegue una query di tipo insert, update o delete
$objdb->ultimo_id() - restituisce l'ultimo valore di tipo autoincrement inserito in una tabella
$objdb->query_preparata($sql,&$arinput,&$aroutput,$tipoparaminput = "") - crea ed esegue una prepared query;
$objdb->nomecampo($indice_campo) - restituisce il nome del campo in posizione $indice_campo
$objdb->numrec() - restituisce il numero di righe restituito da una query
$objdb->gorecord($riga) - sposta in cursore alla riga $riga
$objdb->numcampi() - restituisce il numero di campi di una query
 */



class Connessione
{
	private $host; // indirizzo server mysql
	private $user; // nome utente sul server mysql
	private $password; // password sul server mysql
	private $db; // database di lavoro
	private $connessione; // handle connessione
	
	
	function __construct($host,$user,$password,$db)
	{
			$this->host = $host;
			$this->user = $user;
			$this->password = $password;
			$this->db = $db;
			
			$this->crea_connessione();
	}
	
	function __get($p)
	{
			return $this->{$p};
	}
	
	function __destruct()
	{
			
			@mysqli_close($this->connessione);
	}

	
		
	private function crea_connessione()
	{
			try
			{
				$this->connessione = @new mysqli($this->host,$this->user,$this->password,$this->db);
				
				if($this->connessione->connect_errno)
				{
					throw new Exception("Errore durante apertura del database!!!");	
					
				}
				
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				exit();
			}	
	
	}
}

/* 

classe Database_Mysql create il 24-01-2015 da Chiriaco Francesco
ultima modifica: 24-01-2015

creazione:  $objdb = new Database_Mysql("localhost","root","password","database");

*/

class Database_Mysql implements Iterator
{
	
	
	static $objconnessione; // oggetto connessione
	private $resultset = false; // oggetto risultati query
	private $resultset_numrighe = 0; // numero righe restituite
	private $resultset_numrigacorrente = 0; // record corrente
	
	
	function __construct($host,$user,$password,$db)
	{
		if(!self::$objconnessione)
		{
			
			self::$objconnessione = new Connessione($host,$user,$password,$db);	
			
		}
	
	}
	
	function __get($p)
	{
			return $this->{$p};
	}
	
		
	function query_select($sql) // query che esegue una select
	{
			try
			{
				$this->resultset =  self::$objconnessione->connessione->query($sql);
				if(!$this->resultset)
					throw new Exception("Errore nella query!!");
				$this->resultset_numrighe = $this->resultset->num_rows;
				$this->resultset_numrigacorrente = 0;
				return $this->resultset;
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				exit;
			}
			
	}
	
	
	
	function query_aggiornamento($sql) // query che esegue una insert, una delete o una update
	{
			try
			{
				$risultato = self::$objconnessione->connessione->query($sql);
				if(!$risultato)
					throw new Exception("Errore nella query!!");
				
				/* return self::$objconnessione->connessione->affected_rows; */
				return true;
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				
				exit;
			}
			
	}


	function ultimo_id()
	{
			try
			{
				$lastid = self::$objconnessione->connessione->insert_id;
				if(!$lastid)
					throw new Exception("Errore nessun record con campo auto_increment inserito!!");
				
				return $lastid;
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				
				exit;
			}
	}

	/* implementazione interfaccia iteratore */
	
	public function rewind()
	{
			
				$this->resultset->data_seek(0);
				$this->resultset_numrigacorrente = 0;
			
	}
	
	public function current()
	{
			$r = $this->resultset->fetch_assoc();
			return $r;
	}
	
	public function next()
	{
			$this->resultset_numrigacorrente++;
			$this->resultset->data_seek($this->resultset_numrigacorrente);
			$r = $this->resultset->fetch_assoc();
			return $r;
	}
	
	public function valid()
	{
			return ($this->resultset_numrigacorrente < $this->resultset_numrighe);
	}
	
	public function key()
	{
			
			return $this->resultset_numrigacorrente;
	}
	
	
	
	
	
	/* fine interfaccia iteratore */
	
	
	/* funzione query_preparata creata da Francesco Chiriaco il 22-02-2015
	
		descrizione parametri:
		$sql query da eseguire es. "select cognome,nome from utenti where cognome like ?";
		
		$arinput = array con i parametri di input, se non ci sono parametri di input creare una variabile stringa vuota  e passarla al posto
		del parametro $arinput es. $vuoto = "";
		
		$aroutput = array con le variabili di output, se non restituisce risultati  creare una variabile stringa vuota  e passarla al posto
		del parametro $aroutput es. $vuoto = "";
		
		$tipoparaminput variabile stringa che contiene il tipo dei parametri di input es. "issi" se non ci sono la si può trascurare
		
		
		esempio codice:
		
		
		$objdb = new Database_Mysql("indirizzoservermysql","nomeutente","xxxxxxx","tabella");
		$sql = "select cognome,nome from utenti where cognome like ?";
		$tipoparam = "s";
		$arinput = array("cognome"=>"d%");
		$aroutput = array("cognome"=>"","nome"=>"");
		$stm = $objdb->query_preparata($sql,$arinput,$aroutput,$tipoparam);
		while($stm->fetch())
			echo $aroutput["cognome"] . "<br />";
		
	*/
	
	public function query_preparata($sql,&$arinput,&$aroutput,$tipoparaminput = "")
	{

			try
			{
				$stm = self::$objconnessione->connessione->prepare($sql);
				if(!$stm)
					throw new Exception("Errore durante la preparazione della query!!!!");
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
			$stringabind = "";
			if($tipoparaminput != "")
			{
					
					$stringabind = '$stm->bind_param($tipoparaminput,';
					foreach($arinput as $k => $v)
						$stringabind .= '$arinput["' . $k . '"],';
					$stringabind = substr($stringabind,0,strlen($stringabind) -1) . ');';
					
			}
			
			eval($stringabind);
			
						
			try
			{			
				$ret = $stm->execute();
				if(!$ret)
					throw new Exception("Errore durante esecuzione query preparata!!!!");
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
			if(is_array($aroutput))
			{
					$stringabind = '$stm->bind_result(';
					foreach($aroutput as $k => $v)
						$stringabind .= '$aroutput["' . $k . '"],';
					$stringabind = substr($stringabind,0,strlen($stringabind) -1) . ');';
						
			}
			
			eval($stringabind);
			mysqli_stmt_store_result($stm);
		return $stm;
	}
	
	
	
/*
  nomecampo è una funzione che restituisce il nome del campo di una certa query eseguita
  esempio di utilizzo:
  $nome = $database->nomecampo($indicecampo);
  echo $nome;
*/
	public function nomecampo($indice_campo)
	{
		if($this->resultset !== false)
		{
			$ar = $this->resultset->fetch_fields();
			return $ar[$indice_campo]->name;
		}
		else
			return "ERRORE!!!";
	}
	
	
/*
  numrec è una funzione che restituisce il numero di record restituiti da una query
  esempio di utilizzo:
  $database->numrec();
  echo $num;
*/

public function numrec()
 {
	 if($this->resultset !== false)
		return $this->resultset->num_rows;
   else
   	 return 0;
 }
 
 
 /*
  gorecord è una funzione che sposta il puntatore del record in posizione $riga
  esempio di utilizzo:
  $database->gorecord(0);
  si sposta al primo record
*/
 
 public function gorecord($riga)
 {
	 if($this->resultset !== false)
	 {
		$this->resultset->data_seek($indice);
		$this->resultset_numrigacorrente = $riga;
	 }
 }
 
 
 /*
  numcampi è una funzione che restituisce il numero di campi restituiti da una query
  esempio di utilizzo:
 
  $num = $database->getnumcampi();
  echo $num;
*/
 
 public function numcampi()
 {
   return $this->resultset->field_count;
  }
  
  public function recordcorrente()
 {

   if($this->resultset !== false)
   	$riga = $this->resultset->fetch_assoc();
   else
	$riga = false;
   return $riga;
 }

} // fine classe Database_mysql





?>
