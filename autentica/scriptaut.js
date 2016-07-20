$(document).ready(function(){


$(document).on('click','#subm',function(){
	
	
	$.post('autentica/checkunamepwd.php',{'username':$('#utregn').val(),'password':$('#utregp').val()},function(data){
		
		if(parseInt(data) != 0)
		{
				
				
				$('#panreg').html(data);
				
		}
		else
			alert("Utente sconosciuto!");
		
		});
	
	});

});

function logout()
{
	$.post('autentica/logout.php',{'p':1},function(data){
		
				
				
				$('#panreg').html(data);
				
						
		
		});
}
