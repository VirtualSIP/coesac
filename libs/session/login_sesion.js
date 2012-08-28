var jefform = jQuery.noConflict();
jefform(document).ready(function(){
	jefform(".login_sesion").click(function() {
		
		var login_user = jefform("#loginUser").val();
			login_pass = jefform("#loginPass").val();
			
		if (login_user == "") {
		    jefform("#login_user").focus();
			jefform("#login_user").addClass("error-user");
		    return false;
		}else if (login_pass == "") {
		    jefform("#login_pass").focus();
			jefform("#login_pass").addClass("error-pass");
		    return false;
		}else {
			jefform('.imagen').removeClass('ocultar');
			var datos = 'login_user='+ login_user + 
						'&login_pass='+ login_pass;
			jefform.ajax({
	    		type: "POST",
	    		url: "libs/session/login_sesion.php",
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