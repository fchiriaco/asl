<?php

/* 

Autore: Francesco Chiriaco
Data: 17-2-2011
Dove: Agropoli (SA)

Descrizione:
classe con metodo statico connessione per effettuare la connessione al dbms 

esempio:
$con = DB_MYSQL::connessione("localhost","nomeutente","password","database");

*/

class DB_MYSQL 
{
	static $con = false;

	
	
	static function connessione($host,$user,$password,$db)
	{
		if(!self::$con)
		
			{
				self::$con = @new mysqli($host,$user,$password,$db);
				if(mysqli_connect_errno() != 0)
				{
					echo "Errore durante la connessione al DBMS MYSQL...." . mysqli_connect_error();
					exit;
				}
			}
		
		
		return self::$con;
	}

}


/* 

Autore: Francesco Chiriaco
Data: 17-2-2011
Dove: Agropoli (SA)

Descrizione:
classe con metodo statico connessione per effettuare la connessione al dbms 

esempio:
$con = DB_ODBC::connessione("mysql://nomeutente:password@host/nomedb");

*/


class DB_ODBC 
{
	static $con = false;

	
	
	static function connessione($dsn)
	{
		if(!self::$con)
			{
				self::$con = DB::connect($dsn);
				if(DB::isError(self::$con))
				{
					echo "Errore durante la connessione al DBMS....";
					exit;
				}
			}
				
		return self::$con;
	}
}



/* 

Autore: Francesco Chiriaco
Data: 17-2-2011
Dove: Agropoli (SA)

Descrizione:
classe astratta qry 

esempio:
Non viene mai istanziata

*/


abstract class qry

{
	
	
	
}



/* 

Autore: Francesco Chiriaco
Data: 17-2-2011
Dove: Agropoli (SA)

Descrizione:
classe per preparare query, eseguirle e se previsto restituirne i risultati 

esempio d'uso:

$con = DB_MYSQL::connessione("localhost","nomeutente","password","database");


$q = new querypreparata("select cognome,nome from utenti where cognome like ?",$con);

$pin = array("tipovar"=>"s","cognome"=>"%");


$pout = array('$cognome','$nome');

$q->esegui($pin);

$righe = $q->getrecord($pout);


print_r($righe); 

echo "<br />";




$q = new querypreparata("insert into utenti values(null,?,?,?,?,PASSWORD(?))",$con);

$pin = array("tipovar"=>"sssss","cognome"=>"Rossi","nome"=>"mario","mail"=>"rossi@libero.it","username"=>"Rossi","password"=>"Rossi");

$q->esegui($pin);

$pin = array("tipovar"=>"sssss","cognome"=>"Bianchi","nome"=>"Enzo","mail"=>"bianchi@libero.it","username"=>"enzob","password"=>"enzob");

$q->esegui($pin)



*/


class querypreparata extends qry

{

	private $statment; /* variabile che contiene la query preparata */


	function __construct($strsql,$con) /* il costruttore prevede 2 parametri stringa sql e handle connessione */
	{
		$this->statment = $con->prepare($strsql);			

	}	
	
	


	function esegui($paraminput="") /* $paraminput è un array associativo, se previsto, come da esempio */
	{

		if(is_array($paraminput))

		{
			$strbind = '$this->statment->bind_param(' . "'" . $paraminput["tipovar"] . "',"; 
			foreach($paraminput as $k=>$v)
			{
				if($k != "tipovar")
					$strbind .= '$' . $k . ","; 	
			}
			
			$bindparam = substr($strbind,0,strlen($strbind) - 1) . ");";
			eval($bindparam);

			foreach($paraminput as $k=>$v)
			{
				$str = '$' . $k . '=' . '"' . $v . '";';
				eval($str);
			}
		}

		
		
		$this->statment->execute();
			
		

		
		
		
				
	}


	function getrecord($paramoutput="") /* $paramoutput è un array come da esempio */
	{
		
		
		if(is_array($paramoutput))

		{
			
			
			
			$bindparam = '$this->statment->bind_result(' . implode(",",$paramoutput). ');';
			eval($bindparam);
			$righe = array();
			$riga = array();
			while($this->statment->fetch())
			{
				
				
				foreach($paramoutput as $v)
				{
					$riga[substr($v,1)] = eval("return substr(" . $v .  ",0);");
					
			
				}
				$righe[] = $riga;
				
				
			}
			
			return $righe;
		}
		
	}

		
	
}