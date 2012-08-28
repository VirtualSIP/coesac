$(document).ready(function() {
	
	//you have to use keyup, because keydown will not catch the currently entered value
	$('input[type=password]').keyup(function() { 
		
		checkform($(this).val());
		
	}).blur(function() {
		$('#pswd_info').hide();
	});
	
});

function checkform(pswd){
	// set password variable
	//var pswd = $(this).val();
	var pswdlength = false; var pswdletter = false; var pswduppercase = false; var pswdnumber = false; 
	
	
	//validate the length
	if ( pswd.length >= 8 ) {
		$('#length').removeClass('invalid').addClass('valid'); pswdlength=true;
	} else {
		$('#length').removeClass('valid').addClass('invalid');  
	}
	
	//validate letter
	if ( pswd.match(/[A-z]/) ) {
		$('#letter').removeClass('invalid').addClass('valid'); pswdletter=true;
	} else {
		$('#letter').removeClass('valid').addClass('invalid');  
	}
	
	//validate uppercase letter
	if ( pswd.match(/[A-Z]/) ) {
		$('#capital').removeClass('invalid').addClass('valid'); pswduppercase=true;
	} else {
		$('#capital').removeClass('valid').addClass('invalid'); 
	}
	
	//validate number
	if ( pswd.match(/\d/) ) {
		$('#number').removeClass('invalid').addClass('valid'); pswdnumber=true;
	} else {
		$('#number').removeClass('valid').addClass('invalid');
	}
	
	if( pswdlength && pswdletter && pswduppercase && pswdnumber){ 
		$('#pswd_info').show();
		return true;
	}else{
		$('#pswd_info').show();
		return false;
	}
}