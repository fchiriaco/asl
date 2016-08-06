$(document).ready(function(){
	
	/* $('a').tooltip(); */
	
	larghezzatd = new Array(100); // array contenente il valore della proprietà width di ogni campo input child
	ncampichild = 0; // numero campi child
	
	nomecamposelecttabparent = $('#salvaform select').attr("id");
	$('#campoparent1').hide();
	$('#rigasalvaparent').hide();
	
	$.post('caricatabellachild.php',{'nomecamposelecttabparent':$('#' + nomecamposelecttabparent).val()},function(data){$('#elenco').html(data);
		$('#rigaadd').hide();
		$('#tchild tbody tr:odd').css('background-color','#E6E6FA');
		$('#tchild tbody tr:even').css('background-color','#FFFACD');
		// calcolo widt e numero campi child
		$.each($('#tchild .riga0 input:text,#tchild .riga0 textarea,#tchild .riga0 select'),function (k,v){
			larghezzatd[k] = $(this).width();
			ncampichild++;
			});
		// calcolo widt e numero campi child
		$.post('caricatabellaparent.php',{'nomecamposelecttabparent':$('#' + nomecamposelecttabparent).val()},function(data) {
				if(parseInt(data) != 0)
				{
					
					arcampi = data.split('|');
					for(i = 0;i< arcampi.length;i++)
					{
						campo = arcampi[i].split('=');
						$('#' + campo[0]).val(campo[1]); 
					}
				}
				
			});
		;}); 
		
	
	$('#' + nomecamposelecttabparent).focus();
	
	
	$('#' + nomecamposelecttabparent).change(function(){
		
			valselect = parseInt($('#' + nomecamposelecttabparent).val());
			if(valselect == -1)
			{
			 $('#campoparent1').show();
			 $('#rigaselectparent').hide();	
			 $('#salvaform input').val('');
			 $('#salva').hide();
			 $('#rigasalvaparent').show();
			}
			if(valselect == 0)
			{
				$('#salvaform input').val('');
			}
			$.post('caricatabellachild.php',{'nomecamposelecttabparent':valselect},function(data){$('#elenco').html(data);
				$('#rigaadd').hide();
				$('#tchild tbody tr:odd').css('background-color','#E6E6FA');
				$('#tchild tbody tr:even').css('background-color','#FFFACD');
				$.post('caricatabellaparent.php',{'nomecamposelecttabparent':$('#' + nomecamposelecttabparent).val()},function(data) {
					
					if(parseInt(data) != 0)
					{
						
						arcampi = data.split('|');
						for(i = 0;i< arcampi.length;i++)
						{
							campo = arcampi[i].split('=');
							$('#' + campo[0]).val(campo[1]); 
						}
					}
					});
				}); 
		});
		
		
		$('#salvaparent').click(function(e){
			
			
			campoparent1 = $.trim($('#campo1parent').val());
			campoparent2 = $('#salvaform input').eq(1).val();
			campoparent3 = $('#salvaform input').eq(2).val();
			campoparent4 = $('#salvaform input').eq(3).val();
			campoparent5 = $('#salvaform input').eq(4).val();
			if(campoparent1 == "")
			{
				alert('Dati insufficienti per salvare');
			    $('#campoparent1').hide();
				$('#rigaselectparent').show();	
				$('#salvaform input').val('');
				$('#salva').show();
				$('#rigasalvaparent').hide();
				$('#' + nomecamposelecttabparent).trigger('change');
				return;
			}
			$.post('salvaparent.php',{'campoparent1':campoparent1,'campoparent2':campoparent2,'campoparent3':campoparent3,'campoparent4':campoparent4,'campoparent5':campoparent5},function(data){
				alert(data);
				$('#campoparent1').hide();
				$('#rigaselectparent').show();	
				$('#salvaform input').val('');
				$('#salva').show();
				$('#rigasalvaparent').hide();
				
				$.post('caricaselectparent.php',{'idparent':$('#' + nomecamposelecttabparent).val()},function(data) {
					$('#selectparent').html(data);
					valscroll = $('#rigaadd').offset().top;
			
					$('body').scrollTop(valscroll);
				});
				
				
				$('#' + nomecamposelecttabparent).trigger('change');
				});
				
				e.preventDefault();
			});
		
	
	
	$('#salva').click(function(e){
		$('#rigaadd').show();
		$.post('caricaselectparent.php',{'idparent':$('#' + nomecamposelecttabparent).val()},function(data) {
			$('#selectparent').html(data);
			valscroll = $('#rigaadd').offset().top;
			
			$('body').scrollTop(valscroll);
		});
		
		e.preventDefault();
		
		
		});
	
	
	
	$('#rinuncia').click(function(e){
		
		$('#' + nomecamposelecttabparent).trigger('change');
		
		});
	
	/*
	$(document).on('focus','#tchild input:text,#tchild textarea,#tchild select',function (){
		
			indice = parseInt($('#tchild input:text,#tchild textarea,#tchild select').index($(this))) % ncampichild ;
					
			$(this).css('width',larghezzatd[indice] +150);
		});	
	
	 $(document).on('blur','#tchild input:text,#tchild textarea,#tchild select',function (){
			indice = parseInt($('#tchild input:text,#tchild textarea,#tchild select').index($(this))) % ncampichild ;
			$(this).css('width',larghezzatd[indice]);
		}); 	
		*/
});



function elimina(obj)
{
		if(window.confirm('Sei sicuro di voler cancellare il dato?') == false)
		{
				return;
		}
		idrec = $(obj).attr('id');
		id = idrec.substr(1);
		$.post("deleterec.php",{'id':id},function (data){
			
			
			$('#' + nomecamposelecttabparent).trigger('change');
			
			});
		
}

function modifica(obj)
{
		idrec = $(obj).attr('id');
		id = idrec.substr(1);
		campo1 = $.trim($('#a'+ id).val()) + "";
		if(campo1 == "")
		{
			alert("Campo obbligatorio non compilato...");
			return false;
		}
		campo2 = parseInt($('#b'+ id).val());
		if(campo2 <= 0)
		{
			alert("Nessun valore selezionato...");
			return false;
		}
		campo3 = $('#c'+ id).val() + "";
		campo4 = $('#d'+ id).val() + "";
		
		$.post("modifica.php",{'id':id,'campo1':campo1,'campo2':campo2,'campo3':campo3,'campo4':campo4},function (data){
			
			alert(data);
			$('#' + nomecamposelecttabparent).trigger('change');
			
			});
		
}


function aggiungirigachild(obj)
{
		
		campo1 = $.trim($('#a0').val()) + "";
		if(campo1 == "")
		{
			alert("Campo obbligatorio non compilato...");
			return false;
		}
		campo2 = parseInt($('#b0').val());
		if(campo2 <= 0)
		{
			alert("Nessun valore selezionato...");
			return false;
		}
		campo3 = $('#c0').val() + "";
		campo4 = $('#d0').val() + "";
		
		$.post("addchild.php",{'campo1':campo1,'campo2':campo2,'campo3':campo3,'campo4':campo4},function (data){
			
			alert(data);
			$('#' + nomecamposelecttabparent).trigger('change');
			
			});
		
}


