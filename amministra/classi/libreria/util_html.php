<?

function aprihtml()
{
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
}


function apriheader($titolo="titolo pagina",$fogliostile="")
{

	echo "<head>\n";
	echo "<title>$titolo</title>\n";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
	if($fogliostile != "")
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$fogliostile\" />\n";
	

}




function chiudiheader()
{
	echo "</head>\n<body>\n";
}



function chiudihtml()
{
	echo "</body>\n";
	echo "</html>\n";
}
?>