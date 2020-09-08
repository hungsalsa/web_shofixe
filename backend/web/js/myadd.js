$(document).ready(function() {
	$('#datacuahang').keyup(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
    	// alert('enter');

    	if(keycode == '13'){
    		abc = $(this).val();
    		console.log(abc);
    		$(this).val("");
    	}
    });

});

