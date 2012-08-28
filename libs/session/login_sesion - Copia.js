var jefform = jQuery.noConflict();
jefform(document).ready(function(){
	jefform(".login_sesion").click(function() {
		
		var asoc_nombre = jefform("#fc_asoc_nombre").val();
			asoc_pais = jefform("#fc_asoc_pais").val();
			validacion_email = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
			
		if (asoc_nombre == "") {
		    jefform("#fc_asoc_nombre").focus();
			jefform("#fc_asoc_nombre").addClass("error-iptx1");
		    return false;
		}else if (asoc_pais == "") {
		    jefform("#fc_asoc_pais").focus();
			jefform("#fc_asoc_pais").addClass("error-iptx2");
		    return false;
		}else if (asoc_zip == "") {
		    jefform("#fc_asoc_zip").focus();
			jefform("#fc_asoc_zip").addClass("error-iptx2");
		    return false;
		}else if (asoc_direccion == "") {
		    jefform("#fc_asoc_direccion").focus();
			jefform("#fc_asoc_direccion").addClass("error-iptx1");
		    return false;
		}else if (asoc_telcasa == "") {
		    jefform("#fc_asoc_telcasa").focus();
			jefform("#fc_asoc_telcasa").addClass("error-iptx2");
		    return false;
		}else if(asoc_email == "" || !validacion_email.test(asoc_email)){
		    jefform("#fc_asoc_email").focus();
			jefform("#fc_asoc_email").addClass("error-iptx2");
		    return false;
		}else if(asoc_teloficina == ""){
		    jefform("#fc_asoc_teloficina").focus();
			jefform("#fc_asoc_teloficina").addClass("error-iptx2");
		    return false;
		}else if(asoc_num == ""){
		    jefform("#fc_asoc_num").focus();
			jefform("#fc_asoc_num").addClass("error-iptx3");
		    return false;
		}else if(rep_cargo == ""){
		    jefform("#fc_rep_cargo").focus();
			jefform("#fc_rep_cargo").addClass("error-iptx2");
		    return false;
		}else if(rep_nombre == ""){
		    jefform("#fc_rep_nombre").focus();
			jefform("#fc_rep_nombre").addClass("error-iptx1");
		    return false;
		}else if(rep_direccion == ""){
		    jefform("#fc_rep_direccion").focus();
			jefform("#fc_rep_direccion").addClass("error-iptx1");
		    return false;
		}else if(rep_telcasa == ""){
		    jefform("#fc_rep_telcasa").focus();
			jefform("#fc_rep_telcasa").addClass("error-iptx2");
		    return false;
		}else if(rep_email == ""){
		    jefform("#fc_rep_email").focus();
			jefform("#fc_rep_email").addClass("error-iptx2");
		    return false;
		}else if(rep_teloficina == ""){
		    jefform("#fc_rep_teloficina").focus();
			jefform("#fc_rep_teloficina").addClass("error-iptx2");
		    return false;
		}else if(rep_telcelular == ""){
		    jefform("#fc_rep_telcelular").focus();
			jefform("#fc_rep_telcelular").addClass("error-iptx2");
		    return false;
		}else {
			jefform('.imagen').removeClass('ocultar');
			var datos = 'asoc_nombre='+ asoc_nombre + 
						'&asoc_pais='+ asoc_pais + 
						'&asoc_zip='+ asoc_zip + 
						'&asoc_direccion='+ asoc_direccion + 
						'&asoc_telcasa='+ asoc_telcasa + 
						'&asoc_email='+ asoc_email + 
						'&asoc_teloficina='+ asoc_teloficina + 
						'&asoc_num='+ asoc_num + 
						'&rep_cargo='+ rep_cargo + 
						'&rep_nombre='+ rep_nombre + 
						'&rep_direccion='+ rep_direccion +
						'&rep_telcasa='+ rep_telcasa + 
						'&rep_email='+ rep_email + 
						'&rep_teloficina='+ rep_teloficina + 
						'&rep_telcelular='+ rep_telcelular;
			jefform.ajax({
	    		type: "POST",
	    		url: "procesos/proc-inscripcion-envio.php",
	    		data: datos,
	    		success: function() {
					jefform('.imagen').hide();
					jefform('.contac_msj').slideUp(1500).show();
					jefform('form').slideUp(1500).show;
					jefform('#msj_enviado').slideDown(2000).show();
	    		},
				error: function() {
					jefform('.imagen').hide();
					jefform('#msj_enviado').slideDown(1000).show();				
				}
	   		});
	 		return false;	
		}
	});
});