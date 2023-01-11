$(document).ready(function(){
    function get_cli(){
        var request= $.ajax({
            url:"http://appliweb.seedweb.fr/api/public/api/clients", method:"GET",
            dataType:'json',
            beforeSend: function( xhr ){
                xhr.overrideMimeType("application/json; charset=utf-8");
            }});
            request.done(function(code){
                console.log(code);
            });

            request.fail(function( jqXHR, textStatus){
                console.log("erreur");
            });
    }

    function add_cli(){
        var request= $.ajax({
            url:"http://appliweb.seedweb.fr/api/public/api/clients", 
            method:"POST",
            data: JSON.stringify({
                "nom": $(".nomCliAdd").val(),
                "prenom": $(".prenomCliAdd").val(),
                "adresse": $(".adresseCliAdd").val(),
                "societe": $(".societeCliAdd").val(),
                "mail": $(".mailCliAdd").val(),
                "pwd": $(".pwdCliAdd").val(),
            }),
            headers: {
                'Accept' : 'application/json',
                'Content-Type' : 'application/json'
            },
            dataType:'json',
        });

            request.done(function(msg){
                console.log("Ajout ok");
            });

            request.fail(function(jqXHR, textStatus, error){
                console.log(error);
            });
    }


    if($(".add_Client").click(function(){
        add_cli();
        console.log(typeof $(".nomCliAdd").val());
    }));

});