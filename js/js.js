$(document).ready(function() {	

	$('#login_registreer').click(function() {
		if ($('#login').is(':hidden')) {
			$('#registratie').hide();
			$('#login').show();
			$('#login_registreer').text("Registratie formulier");
		} else {
			$('#login').hide();
			$('#registratie').show();
			$('#login_registreer').text("Log-in formulier");
		};
	});

	$('#woord_input').bind('keypress', function (event) {
	    var regex = new RegExp("^[a-zA-Z\r\n]+$");
	    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	    if (!regex.test(key)) {
	       event.preventDefault();
	       return false;
	    }
	});
		
});