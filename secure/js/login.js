$( "#login" ).submit(function( event ) {
    event.preventDefault();
	handleLogin();
});

function handleLogin(){
    var mail = $( "#mail" )[0].value;
    var password = $( "#password" )[0].value;
    $.ajax({
        url: "php/login.php",
        method: "POST",
        data: { mail: mail, password: password }
    })
        .done(function( loginSuccessful ) {
			loginSuccessful = parseInt(loginSuccessful);
			if(loginSuccessful === 1){
            var win = window.open('index.php', '_self');
			} else {
				$('#info-text').text('Wrong combination.');
			}
        });
}