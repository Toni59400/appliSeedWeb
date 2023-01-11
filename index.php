<?php
include("./includes/layout.php");
?>

        <form>
            <h1 class="text-center">Ajout d'un client.</h1>
            <div class="form-group">
                <label for="exampleInputEmail1">Nom</label>
                <input type="text" class="form-control nomCliAdd" placeholder="Exemple">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Prenom</label>
                <input type="text" class="form-control prenomCliAdd" placeholder="Exemple">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Adresse</label>
                <input type="text" class="form-control adresseCliAdd" placeholder="8 rue de Paris 62000 Arras">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Societe</label>
                <input type="text" class="form-control societeCliAdd" placeholder="Exemple">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mail</label>
                <input type="mail" class="form-control mailCliAdd" placeholder="exemple@exemple.fr">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mot de passe</label>
                <input type="password" class="form-control pwdCliAdd">
            </div>
            <p class="btn btn-primary add_Client" >Ajouter</p>
        </form>

<?php
include("./includes/layout_bottom.php");
?>