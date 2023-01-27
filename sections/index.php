<?php
include("../config/config.php");
include("../config/dbconnection.php");
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
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
        <title>SeedWeb | Sections</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "admin"){

            $req_site = $db->query("SELECT * FROM section");
            if(isset($_POST["search_page"])){
                if(isset($_POST['terme_page'])){
                    $val = $_POST['terme_page'];

                    $req_site = $db->query("SELECT * FROM section where nom like '%$val%'");    
                }
            }
            $data_pages = $req_site->fetchAll();

?>
    <div class="container">
                <h1>Sections</h1>
                <hr>
                <form method="POST">
                    <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                        <input class="form-control me-1 ms-2" name="terme_page" type="search" placeholder="Recherche par nom de la section" aria-label="Search">
                        <input type="submit" name="search_page" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                    </div>
                </form>
                    <div class="w-50 ">
                            <div class="row g-3 justify-content-between mt-3">
                                <form method="POST">
                                <div class="col-auto mb-2">
                                    <input type="text" id="" class="form-control" name="nomSectionAjouter" placeholder="Nom de la Section" required>
                                </div>
                                <input type="submit" value="Ajouter la section" name="add_section" class="bgSeed rounded-pill color_white border_white"/>
                                </form>
                            </div>
                    </div>
                <br><br>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                                foreach ($data_pages as $page) {
?>
                            <tr>
                                <th scope="row"><?=$page["id"]?></th>
                                <td><?=$page["nom"]?></td>
                                <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item actionAdmin sup_section" data_sup="<?=$page['id']?>">Supprimer</a></li>
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
?>
<h1>Pas d'autorisation pour accéder à cette page.</h1>
<?php
}}
    include("../includes/layout_bottom.php");

    if(isset($_POST["add_section"])){
        if(isset($_POST["nomSectionAjouter"]) && !empty($_POST["nomSectionAjouter"])){
            $nom_section = $_POST["nomSectionAjouter"];
            $req_insert_section = $db->prepare("INSERT INTO section(nom) value ('$nom_section')");
            $req_insert_section->execute();
            echo '<meta http-equiv="refresh" content="0">';
    }
}

if(isset($_GET["id_section_supp"])){
    $id_supp = $_GET["id_section_supp"];
    $req_supp = $db->prepare("DELETE FROM section where id = '$id_supp'");
    $req_supp->execute();
    echo "<script>redi()</script>";
}
?>