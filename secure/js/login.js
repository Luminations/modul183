$( "#submit" ).click(function( event ) {
    event.preventDefault();
    var mail = $( "#mail" )[0].value;
    var password = $( "#password" )[0].value;
    $.ajax({
        url: "php/login.php",
        method: "POST",
        data: { mail: mail, password: password }
    })
        .done(function( data ) {
            console.log( data );
            /*
            var win = window.open(imgUri, '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Browser has blocked it
                alert('Please allow popups for this website');
            }*/
        });
});