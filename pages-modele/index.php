<?php
include("../config/config.php");
include("../config/dbconnection.php");
session_start();
if(!isset($_SESSION['theme'])){
    $_SESSION["theme"] = "light";
    }
    if(isset($_POST["dark"])){$_SESSION["theme"] = "dark";} if(isset($_POST["light"])){ $_SESSION["theme"] = "light";}
    ?>
<!DOCTYPE HTML>
<html lang="fr" data-bs-theme="<?=$_SESSION["theme"]?>">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>SeedWeb | Pages Modèles</title>
        <link rel="icon" href="../img/ico.png" />
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");

    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == "admin"){
            
            $req_site = $db->query("SELECT * FROM page_modele");
            if(isset($_POST["search_page"])){
                if(isset($_POST['terme_page'])){
                    $val = $_POST['terme_page'];

                    $req_site = $db->query("SELECT * FROM page_modele where page_modele.nom like '%$val%' or id_modele in (SELECT id from modele where nom like '%$val%')");    
                }
            }
            
            $req_modele_add = $db->query("SELECT * FROM modele");
            $req_pages = $db->query("SELECT * FROM page_modele");
            $data_pages = $req_site->fetchAll();
            $data_modele = $req_modele_add->fetchAll();

?>
    <div class="container">
                <h1>Pages Modèles</h1>
                <hr>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../accueil/index.php">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="../modeles/index.php">Modèles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pages Modèles</li>
                    </ol>
                </nav>
                <form method="POST">
                    <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                        <input class="form-control me-1 ms-2" name="terme_page" type="search" placeholder="Nom du modèle ou de la page" aria-label="Search">
                        <input type="submit" name="search_page" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                    </div>
                </form>
                    <div class="w-50 ">
                            <div class="row g-3 justify-content-between">
                                <form method="POST">
                                <div class="col-auto mb-2">
                                    <input type="text" id="" class="form-control" name="nomPageAjouter" placeholder="Nom de la Page" required>
                                </div>
                                <select class="form-select mb-2" name="select_modele" aria-label="Default select example">
                                    <option selected>Modèles</option>
<?php
                                        foreach($data_modele as $mod){
?>
                                    <option value="<?=$mod["id"]?>"><?=$mod["nom"]?></option>
<?php
                                        }
?>
                                </select>
                                <input type="submit" value="Ajouter la page" name="add_pageM" class="bgSeed rounded-pill color_white border_white"/>
                                </form>
                            </div>
                    </div>
                <br><br>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Appartient à</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Image(s)</th>
                                <th scope="col">Texte(s)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                                foreach ($data_pages as $page) {
                                    
                                    $id = $page["id_pageM"];
                                    $idM = $page['id_modele'];
                                    $req_mod_appartient = $db->query("SELECT * FROM modele where id = '$idM';");
                                    $req_nbImg = $db->query("SELECT * from image_modele where id_pageM = '$id';");
                                    $req_nbTxt = $db->query("SELECT * from texte_modele where id_pageM = '$id';");
                                    $nbImg = $req_nbImg->rowCount();
                                    $nbTxt = $req_nbTxt->rowCount();
                                    $modele = $req_mod_appartient->fetch();
?>
                            <tr>
                                <th scope="row"><?=$page["id_pageM"]?></th>
                                <td><?=$modele["nom"]?></td>
                                <td><?=$page["nom"]?></td>
                                <td><?=$nbImg?></td>
                                <td><?=$nbTxt?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item actionAdmin sup_pageM" data_sup="<?=$page['id_pageM']?>">Supprimer</a></li>
                                            <li><a class="dropdown-item actionAdmin" href="../images-modele/index.php?page_id=<?=$page['id_pageM']?>">Voir les images</a></li>
                                            <li><a class="dropdown-item actionAdmin" href="../textes-modele/index.php?page_id=<?=$page['id_pageM']?>">Voir les textes</a></li>
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

        header('Location: ../index.php');
    }
?>
<?php

if(isset($_POST["add_pageM"])){
    if(isset($_POST["nomPageAjouter"]) && !empty($_POST["nomPageAjouter"])){
        $nom_page = $_POST["nomPageAjouter"];
        $idModele = $_POST["select_modele"];
        $req_insert_page = $db->prepare("INSERT INTO page_modele(nom, id_modele) value ('$nom_page', '$idModele')");
        $req_insert_page->execute();
        $lien = "index.php?modele_id=".$idM;
        echo '<meta http-equiv="refresh" content="0">';
}
}
if(isset($_GET["id_page_supp"])){
    $id_supp = $_GET["id_page_supp"];
    $req_supp = $db->prepare("DELETE FROM page_modele where id_pageM = '$id_supp'");
    $req_supp->execute();
    echo "<script>redi()</script>";
}


    }
    include("../includes/layout_bottom.php");
?>