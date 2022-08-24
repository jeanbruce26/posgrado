
function scroll_to_class(element_class, removed_height) {
	var scroll_to = $(element_class).offset().top - removed_height;
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 0);
	}
}

function bar_progress(progress_line_object, direction) {
	var number_of_steps = progress_line_object.data('number-of-steps');
	var now_value = progress_line_object.data('now-value');
	var new_value = 0;
	if(direction == 'right') {
		new_value = now_value + ( 100 / number_of_steps );
	}
	else if(direction == 'left') {
		new_value = now_value - ( 100 / number_of_steps );
	}
	progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

jQuery(document).ready(function() {
	
    $('#top-navbar-1').on('shown.bs.collapse', function(){
		$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
		$.backstretch("resize");
    });
    
    /*
        Form
    */
    $('.f1 .fieldset:first').fadeIn('slow');
	
    // next step
    $('.f1 .btn-next').on('click', function() {
		var parent_fieldset = $(this).parents('.fieldset');
		var next_step = true;
		// navigation steps / progress steps
		var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');

		
		var tipo_doc_cod_tipo, num_doc, apell_pater, apell_mater, nombres, sexo, fecha_naci, est_civil_cod_est, id_grado_academico, celular1, email, cod_depar, cod_provin, id_distrito1, direccion, cod_depar2, cod_provin2, id_distrito2, año_egreso, univer_cod_uni, centro_trab;
		tipo_doc_cod_tipo = $(".tipoDoc").val();
		num_doc = $(".numDoc").val();
		apell_pater = $(".apePater").val();
		apell_mater = $(".apeMater").val();
		nombres = $(".nomb").val();
		sexo = $(".sexo").val();
		fecha_naci = $(".fechaNaci").val();
		est_civil_cod_est = $(".estCivil").val();
		id_grado_academico = $(".gradoAcademico").val();
		celular1 = $(".cel").val();
		email = $(".email").val();
		cod_depar = $(".depart").val();
		cod_provin = $(".provincia").val();
		id_distrito1 = $(".distrito").val();
		direccion = $(".direc").val();
		cod_depar2 = $(".departNaci").val();
		cod_provin2 = $(".provinciaNaci").val();
		id_distrito2 = $(".distritoNaci").val();
		año_egreso = $(".anioEgreso").val();
		univer_cod_uni = $(".universidad").val();
		centro_trab = $(".centroTrab").val();

		if(tipo_doc_cod_tipo.length==0 || num_doc.length==0 || apell_pater.length==0 || apell_mater.length==0 || nombres.length==0 || sexo.length==0 || fecha_naci.length==0 || est_civil_cod_est.length==0 || id_grado_academico.length==0 || celular1.length==0 || email.length==0 || cod_depar.length==0 || cod_provin.length==0 || id_distrito1.length==0 || direccion.length==0 || cod_depar2.length==0 || cod_provin2.length==0|| id_distrito2.length==0 || año_egreso.length==0 || univer_cod_uni.length==0 || centro_trab.length==0){
			Swal.fire({
				icon: 'error',
				title: 'Campos de textos vacios',
				text: '¡Ingrese los campos de textos requeridos!'
			})
		}else if(next_step ) {
			parent_fieldset.fadeOut(400, function() {
				// change icons
				current_active_step.removeClass('active').addClass('activated').next().addClass('active');
				// progress bar
				bar_progress(progress_line, 'right');
				// show next step
				$(this).next().fadeIn();
				// scroll window to beginning of the form
				scroll_to_class( $('.f1'), 20 );
			});
		}
    });
    
    // previous step
    $('.f1 .btn-previous').on('click', function() {
    	// navigation steps / progress steps
		var current_active_step = $(this).parents('.f1').find('.f1-step.active');
		var progress_line = $(this).parents('.f1').find('.f1-progress-line');

		$(this).parents('.fieldset').fadeOut(400, function() {
			// change icons
			current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
			// progress bar
			bar_progress(progress_line, 'left');
			// show previous step
			$(this).prev().fadeIn();
			// scroll window to beginning of the form
			scroll_to_class( $('.f1'), 20 );
		});
    });

});

// Example starter JavaScript for disabling form submissions if there are invalid fields

(() => {
	'use strict'

	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	const forms = document.querySelectorAll('.needs-validation')

	// Loop over them and prevent submission
	Array.from(forms).forEach(form => {
	form.addEventListener('submit', event => {
		if (!form.checkValidity()) {
			event.preventDefault()
			event.stopPropagation()
		}

		form.classList.add('was-validated')

		}, false)
	})
})()