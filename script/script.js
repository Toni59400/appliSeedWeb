var client_sup = document.getElementsByClassName("sup_client");
var modele_sup = document.getElementsByClassName("sup_modele");
var site_sup = document.getElementsByClassName("sup_site");
var pageM_sup = document.getElementsByClassName("sup_pageM");

for(let pageM of pageM_sup){
    pageM.addEventListener('click', delete_confirm_pageM, false);
}

for(let modeleS of modele_sup){
    modeleS.addEventListener('click', delete_confirm_modele, false);
}


for(let siteS of site_sup){
    siteS.addEventListener('click', delete_confirm_site, false);
}

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

function delete_confirm_modele(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer le modèle ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_modele_supp="+id
        }});
}

function delete_confirm_site(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer le site du client ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_site_supp="+id
        }});
}

function delete_confirm_pageM(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer la page du modèle ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_page_supp="+id
        }});
}