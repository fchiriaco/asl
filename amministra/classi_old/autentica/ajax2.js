var xmlhttpglob;
var xmlhttpglob2;

function create2XmlHttpRequestObject() 
{
  
  var xmlHttp;
 
  
  try
  {
    // try to create XMLHttpRequest object
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    // assume IE6 or older
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
                                    "MSXML2.XMLHTTP.5.0",
                                    "MSXML2.XMLHTTP.4.0",
                                    "MSXML2.XMLHTTP.3.0",
                                    "MSXML2.XMLHTTP",
                                    "Microsoft.XMLHTTP");
    
    for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) 
    {
      try 
      { 
        
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
      } 
      catch (e) {}
    }
  }
  
  if (!xmlHttp)
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}

function autenticaajax()
{
	
	uname = document.getElementById("utregn");
	pwd = document.getElementById("utregp");
	qs = "username=" + encodeURIComponent(uname.value) + "&password=" + encodeURIComponent(pwd.value);
	xmlhttpglob = create2XmlHttpRequestObject();
	if((xmlhttpglob.readyState == 4) || (xmlhttpglob.readyState == 0))
	{	
		
		xmlhttpglob.open("GET","autentica/checkunamepwd.php?" + qs,true);
		xmlhttpglob.onreadystatechange=handlexml22;
		xmlhttpglob.send(null);
	}

}

function autenticaajaxmobile()
{
	
	uname = document.getElementById("utregnm");
	pwd = document.getElementById("utregpm");
	qs = "username=" + encodeURIComponent(uname.value) + "&password=" + encodeURIComponent(pwd.value);
	xmlhttpglob = create2XmlHttpRequestObject();
	if((xmlhttpglob.readyState == 4) || (xmlhttpglob.readyState == 0))
	{	
		
		xmlhttpglob.open("GET","autentica/checkunamepwdmobile.php?" + qs,true);
		xmlhttpglob.onreadystatechange=handlexmlmobile22;
		xmlhttpglob.send(null);
	}

}

function handlexml22()
{
	
	
	if (xmlhttpglob.readyState == 4)
	{
		
		if(xmlhttpglob.status == 200)
		{
			
			if (xmlhttpglob.responseText != "no")
			  document.getElementById("panreg").innerHTML = xmlhttpglob.responseText;
			else
			{
			  alert("Nome utente o password non corrispondenti");
			  document.getElementById("utregn").value = "";
			  document.getElementById("utregp").value = "";
			

			}
			

			
		}
			
	}
	
	
}


function handlexmlmobile22()
{
	
	
	if (xmlhttpglob.readyState == 4)
	{
		
		if(xmlhttpglob.status == 200)
		{
			
			if (xmlhttpglob.responseText != "no")
			  document.getElementById("panregmobile").innerHTML = xmlhttpglob.responseText;
			else
			{
			  alert("Nome utente o password non corrispondenti");
			  document.getElementById("utregnm").value = "";
			  document.getElementById("utregpm").value = "";
			

			}
			

			
		}
			
	}
	
	
}


function logout()
{
	
	
	xmlhttpglob2 = create2XmlHttpRequestObject();
	if((xmlhttpglob2.readyState == 4) || (xmlhttpglob2.readyState == 0))
	{	
		
		xmlhttpglob2.open("GET","autentica/logout.php",true);
		xmlhttpglob2.onreadystatechange=handlexml23;
		xmlhttpglob2.send(null);
	}

}

function logoutmobile()
{
	
	
	xmlhttpglob2 = create2XmlHttpRequestObject();
	if((xmlhttpglob2.readyState == 4) || (xmlhttpglob2.readyState == 0))
	{	
		
		xmlhttpglob2.open("GET","autentica/logoutmobile.php",true);
		xmlhttpglob2.onreadystatechange=handlexmlmobile23;
		xmlhttpglob2.send(null);
	}

}


function handlexml23()
{
	
	
	if (xmlhttpglob2.readyState == 4)
	{
		
		if(xmlhttpglob2.status == 200)
		{
			
			
			 document.getElementById("panreg").innerHTML = xmlhttpglob2.responseText;
			
			

			
		}
			
	}
	
	
}

function handlexmlmobile23()
{
	
	
	if (xmlhttpglob2.readyState == 4)
	{
		
		if(xmlhttpglob2.status == 200)
		{
			
			
			 document.getElementById("panregmobile").innerHTML = xmlhttpglob2.responseText;
			
			

			
		}
			
	}
	
	
}
