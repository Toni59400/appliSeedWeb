var client_sup = document.getElementsByClassName("sup_client");

for(let clientS of client_sup){
    clientS.addEventListener('click', delete_confirm_cli, false);
}

function delete_confirm_cli(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer le client ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_cli_supp="+id
        }});
}