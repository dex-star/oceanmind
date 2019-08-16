jQuery(document).on('submit', '#formlg', function(event){
	event.preventDefault();

	jQuery.ajax({
		url: 'login.php',
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
			$('.btn_login').val('Validando...');
		}
	})
	.done(function(respuesta){
		console.log(respuesta);
		if(!respuesta.error){
			if(respuesta.tipo == 1){
				location.href = 'users/administrador/';
			}else if(respuesta.tipo == 2){
				location.href = 'users/coordinador/';
			}
			else if(respuesta.tipo == 3){
				location.href = 'users/tutor/';
			}
			else if(respuesta.tipo == 4){
				location.href = 'users/tutorado/consultas/consulta-seguridad.php';
			}
		}else{
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
			},1000);
			$('.btn_login').val('Iniciar!');
		}
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("complete");
	});
});

$(".chat-button").on('click', function(e){
        e.preventDefault();
        $(".chat-content").slideToggle('fast');
  });
