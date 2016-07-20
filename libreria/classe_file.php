<?
/* 
questo file è stato creato da Francesco Chiriaco in data 7/8/2004
si tratta di una semplie classe per la gestione dei file

la classe possiede le seguenti proprietà:
$handler: il numero associato al file dopo l'apertura
$name: il nome del file
$path: il percorso, per default la directory corrente
$modoapertura: la modalità con cui è stato aperto

la classe possiede i seguenti metodi:
getname(): restituisce il nome del file
gethandler(): restituisce il numero associato
getmodoapertura(): restituisce la modalità con cui è stato aperto
getpath(): restituisce il percorso del file
isopen(): restituisce true se il file è aperto, false se è chiuso
setname($fname): assegna il nome al file
setepath($fpath): assegna il percorso a file
setmodoapertura($modo): assegna la modalità di apertura
apri($modo = "r"): apre il file, se non viene passato alcun parametro lo apre in modalità di sola lettura
scrivi($frase): scrive su un file una stringa
leggi($numbyte): legge un certo numero di caratteri indicato dalla variabile $numbyte
chiudi(): chiude il file
iseof(): restituisce true se è stata raggiunta la fine del file
spaziooccupato(): restituisce lo spazio occupato in byte
leggiriga(): legge una riga dal file
leggiinarray(): legge l'intero file e restituisce un array contenente le righe del file
leggiall(): legge l'intero file
spostati($nbyte,$dadove=SEEK_CUR): salta nbyte nel file
iniziofile(): sposta il puntatore del file all'inizio

*/



class myfile
{
	var $handler;
	var $name;
	var $path;
	var $aperto;
	var $modoapertura;
	

	 function myfile($fname,$fpath="./")
	{
		$this->name = $fname;
		$this->path = $fpath;
		$this->aperto = false;
	}

	 
	function getname()
	{
		return $this->name;
	}


	function gethandler()
	{
		return $this->handler;
	}
	
	function getmodoapertura()
	{
		return $this->modoapertura;
	}

	function getpath()
	{
		return $this->path;
	}
	
	function isopen()
	{
		if ($this->aperto)
		 return true;
		else
		 return false;
	}

	function setname($fname)
	{
		$this->name = $fname;
		return $fname;
	}

	function setpath($fpath)
	{
		 $this->path = $fpath;
		 return $fpath;
	}


        function setmodoapertura($modo)
	{
		$this->modoapertura = $modo;
		return $modo;
	}

	function apri($modo = "r")
	{
		 
		 $this->setmodoapertura($modo);
		 $this->handler = fopen($this->path . $this->name,$modo);
		 if (!$this->handler)
			die("Errore durante l'apertura del file");
		 $this->aperto = true;
		 return $this->handler;
		
	}
	

	
	

	function scrivi($frase)
	{
		if (!($this->isopen()))
		 $this->apri("a+");
		if ($this->getmodoapertura() == "r")
			die("ERRORE File aperto in sola lettura");
		fwrite($this->handler,$frase);
	}


	function leggi($numbyte)
	{
		if (!($this->isopen()))
		 $this->apri("r");
		$c = fread($this->handler,$numbyte);
		return $c;
	}

	function leggiall()
	{
		if (!($this->isopen()))
		 $this->apri("r");
		$c = fread($this->handler,filesize($this->path . $this->name));
		return $c;	
	}
	
	function chiudi()
	{
		if(!$this->isopen())
			fclose($this->handler);
	}


	function iseof()
	{
		return feof($this->handler);
	}

	function spaziooccupato()
	{
		return filesize($this->name);
	}

	function leggiriga()
	{
		if (!($this->isopen()))
		 $this->apri("r");
		return fgets($this->handler);
	}


	function leggiinarray()
	{
		return file($this->path .$this->name);	
	}
	
	function spostati($nbyte,$dadove=SEEK_CUR)
	{
		fseek($this->handler,$nbyte,$dadove);
	}
	
	function iniziofile()
	{
		rewind($this->handler);
	}


}
?>
