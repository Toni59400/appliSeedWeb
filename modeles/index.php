<?php
include("../config/config.php");
include("../config/dbconnection.php");
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>SeedWeb | Modèles</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "admin"){
        $req_modele = $db->query("SELECT * FROM modele");
        if(isset($_POST["search_modele"])){
            if(isset($_POST['terme_modele'])){
                $val = $_POST['terme_modele'];
                $req_modele = $db->query("SELECT * FROM modele where nom like '%$val%' or prix like '%$val%'");    
            }
        }
        $data_modele = $req_modele->fetchAll();
?>
        <div class="container">
            <h1>Modèles</h1>
            <hr>
            <form method="POST">
                <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                    <input class="form-control me-1 ms-2" name="terme_modele" type="search" placeholder="Rechercher un modèle" aria-label="Search">
                    <input type="submit" name="search_modele" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                </div>
                <div class="w-50 ">
                    <form method="POST">
                        <div class="row g-3 justify-content-between">
                            <div class="col-auto">
                                <label for="" class="col-form-label">Nom</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="" class="form-control" name="nomModeleAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Prix(€HT)</label>
                            </div>
                            <div class="col-auto float-end">
                                <input type="text" id="" class="form-control" name="prixModeleAjouter" aria-describedby="">
                            </div>
                            <input type="submit" value="Ajouter le modèle"  name="add_modele" class="bgSeed rounded-pill color_white border_white"/>
                        </div>
                    </form>
                </div>
            </form>
            <br><br>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($data_modele as $modele) {
                        ?>
                        <tr>
                            <th scope="row"><?=$modele["id"]?></th>
                            <td><?=$modele["nom"]?></td>
                            <td><?=$modele["prix"]?>€</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item actionAdmin sup_modele" data_sup="<?=$modele['id']?>">Supprimer</a></li>
                                        <li><a class="dropdown-item actionAdmin" href="../pages-modele/index.php?modele_id=<?=$modele['id']?>">Voir les pages</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>function redi(){
                window.location = "index.php";
            }
        </script>

<?php
}else{
    header("Location: ../index.php");
?>
<?php
}}
    include("../includes/layout_bottom.php");

    if(isset($_POST["add_modele"])){
        if(isset($_POST["prixModeleAjouter"]) && !empty($_POST["prixModeleAjouter"]) && isset($_POST["nomModeleAjouter"]) && !empty($_POST["nomModeleAjouter"]) ){
            $nom_modele = $_POST["nomModeleAjouter"];
            $prix_modele = $_POST["prixModeleAjouter"];
            $req_insert_modele = $db->prepare("INSERT INTO modele(nom, prix) value ('$nom_modele', '$prix_modele')");
            $req_insert_modele->execute();
            $lien = "index.php";
            echo '<meta http-equiv="refresh" content="0">';
    }
}

if(isset($_GET["id_modele_supp"])){
    $id_supp = $_GET["id_modele_supp"];
    $req_supp = $db->prepare("DELETE FROM modele where id = '$id_supp'");
    $req_supp->execute();
    echo "<script>redi()</script>";
}
?>