var client_sup = document.getElementsByClassName("sup_client");
var modele_sup = document.getElementsByClassName("sup_modele");
var site_sup = document.getElementsByClassName("sup_site");
var pageM_sup = document.getElementsByClassName("sup_pageM");
var imageM_sup = document.getElementsByClassName("sup_image");
var texteM_sup = document.getElementsByClassName("sup_texte");
var page_sup = document.getElementsByClassName("sup_page");
var section_sup = document.getElementsByClassName("sup_section");
var input_span = document.getElementsByClassName("input_counter");
var option = document.getElementsByClassName("add_option");
var envoiMail = document.getElementsByClassName("btn_envoi_form");
var copy = document.getElementsByClassName("copySpan");
var openForm = document.getElementsByClassName("openFormPb");
var closeForm = document.getElementsByClassName("closeForm");

for (let form of closeForm){
    form.addEventListener("click", closeFormFunc, false);
}

for (let form of openForm){
    form.addEventListener("click", openFormFunc, false);
}

for(let copying of copy){
    copying.addEventListener("click", copyInClipBoard, false);
}

for(let clickbtn of envoiMail){
    clickbtn.addEventListener("click", verifEnvoiMail, false);
}

for(let opt of option){
    opt.addEventListener('click', addOpt, false);
}

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

function closeFormFunc(){
    var idForm = this.getAttribute("idForm");
    document.getElementById(idForm).style.display = "none";
}

function openFormFunc(){
    var idForm = this.getAttribute("idForm");
    document.getElementById(idForm).style.display = "block";
}



function copyInClipBoard(){
    var contenuToCopy = this.getAttribute("data_copy");
    console.log(contenuToCopy);
    navigator.clipboard.writeText(contenuToCopy).then(() => {
        
    })
}


function delete_confirm_cli(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer le client ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_cli_supp="+id
        }});
}

function verifEnvoiMail(){
    var mail = this.getAttribute("data_cli");
    var page = this.getAttribute("data_page");
    DayPilot.Modal.confirm("Voulez-vous envoyer un mail ?? "+mail+" pour lui dire que son formulaire est diponible ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?page_id="+page+"&send_form="+mail
        }});
}

$(".meter > span").each(function () {
    $(this)
      .data("origWidth", $(this).width())
      .width(0)
      .animate(
        {
          width: $(this).data("origWidth")
        },
        1200
      );
  });

function delete_confirm_modele(){
    var id = this.getAttribute('data_sup');
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer le mod??le ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            window.location = "index.php?id_modele_supp="+id
        }});
}

function addOpt(){
    var id = this.getAttribute('data_sup');
    var idSite = this.getAttribute('data_page');
    var txt = this.getAttribute('info');
    DayPilot.Modal.confirm("Confirmer ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
        if (args.result){
            console.log(this.innerHTML);
            if(txt == "Ajouter la r??daction"){
                window.location = "index.php?site_id="+idSite+"&id_add="+id
            }
            if(txt == "Supprimer la r??daction"){
                window.location = "index.php?site_id="+idSite+"&id_supp_redac="+id
            }
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
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer la page du mod??le ?", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
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
    DayPilot.Modal.confirm("Voulez-vous vraiment supprimer la section ? Attention les images et textes reli??s ?? celle-ci seront supprim??s ??galement.", {okText:"Oui", cancelText:"Annuler"}).then(function(args) {
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
        span.innerText = leftCharLength + " caract??res restants";
        this.classList.remove("is-invalid");
        spanLimite.style.display="none";
        span.style.display = "inline-block";

    }if(leftCharLength == 0 ){
        this.classList.add("is-invalid");
        span.style.display = "none";
        spanLimite.style.display="inline-block";
    }
} 