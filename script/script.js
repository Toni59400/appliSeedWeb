var client_sup = document.getElementsByClassName("sup_client");
var modele_sup = document.getElementsByClassName("sup_modele");
var site_sup = document.getElementsByClassName("sup_site");
var pageM_sup = document.getElementsByClassName("sup_pageM");
var imageM_sup = document.getElementsByClassName("sup_image");
var texteM_sup = document.getElementsByClassName("sup_texte");
var page_sup = document.getElementsByClassName("sup_page");
var section_sup = document.getElementsByClassName("sup_section");
var input_span = document.getElementsByClassName("input_counter");

for(let input of input_span){
    input.addEventListener('input', afficherNbCarac, false);
}

for(let imageM of imageM_sup){
    imageM.addEventListener('click', delete_confirm_imageM, false);
}

for(let section of section_sup){
    section.addEventListener('click', delete_confirm_section, false);
}

for(let page of page_sup){
    page.addEventListener('click', delete_confirm_page, false);
}

for(let texteM of texteM_sup){
    texteM.addEventListener('click', delete_confirm_texteM, false);
}

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

function delete_confirm_imageM(){
    var id = this.getAttribute('data_sup');
    var id_page = this.getAttribute('data_page');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer l'image de la page ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?page_id="+id_page+"&id_image_supp="+id
        }});
}

function delete_confirm_texteM(){
    var id = this.getAttribute('data_sup');
    var id_page = this.getAttribute('data_page');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer le texte de la page ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?page_id="+id_page+"&id_texte_supp="+id
        }});
}

function delete_confirm_page(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer la page du site client ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_page_supp="+id
        }});
}

function delete_confirm_section(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer la section ? Attention les images et textes reliés à celle-ci seront supprimés également.", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_section_supp="+id
        }});
}

function popUpConfirm(texte){
    DayPilot.Modal.alert(texte , { theme: "modal_flat" });
}



function afficherNbCarac(){
    var id = this.getAttribute('idTexte');
    var nameId = "span_counter_input" + id;
    var nameLimite = "limite" + id ;
    var span = document.getElementById(nameId);
    var spanLimite = document.getElementById(nameLimite);
    var tailleMax = this.getAttribute("maxlength");
    const valueLength = this.value.length;
    const leftCharLength = tailleMax - valueLength;
    if (leftCharLength < 0) return;{
        span.innerText = leftCharLength + " caractères restants";
        this.classList.remove("is-invalid");
        spanLimite.style.display="none";
        span.style.display = "inline-block";
        
    }if(leftCharLength == 0 ){
        this.classList.add("is-invalid");
        span.style.display = "none";
        spanLimite.style.display="inline-block";
    }
}
    