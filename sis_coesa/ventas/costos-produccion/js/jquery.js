var jefform = jQuery.noConflict();
jefform(document).ready(function(){
	
	jefform("#dtecnicos_articulo").change(function() {
	
		//VALORES DE COMBOS
		var clt = jefform("select#dtecnicos_cliente option:selected").val();
		var art = jefform("select#dtecnicos_articulo option:selected").val();
		
		jefform('#laminas_imagen').removeClass("ocultar");
		jefform.post("consulta-laminas.php", {lamina: art, cliente: clt},
			function(data){
				jefform('#laminas').html(data);
				jefform('#laminas_imagen').addClass("ocultar");
			});
		
	});
});