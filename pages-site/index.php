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
        <title>SeedWeb | Pages Sites Clients</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");

    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == "admin"){
            $req_site = $db->query("SELECT * FROM page order by id desc");
            if(isset($_GET["site_id"])){
                $idSite = $_GET['site_id'];
                $req_site = $db->query("SELECT * FROM page where site_id='$idSite' order by id desc");
            }
            if(isset($_POST["search_page"])){
                if(isset($_POST['terme_page'])){
                    $val = $_POST['terme_page'];
                    $req_site = $db->query("SELECT * FROM page where page.nom like '%$val%' or site_id in (SELECT id from site where nom like '%$val%' or url like '%$val%' or modele_id in (SELECT id FROM modele where nom like '%$val%'))");    
                    if(isset($_GET['site_id'])){
                        $idSite = $_GET['site_id'];
                        $req_site = $db->query("SELECT * FROM page where site_id='$idSite' and page.nom like '%$val%' or site_id in (SELECT id from site where nom like '%$val%' or url like '%$val%' or modele_id in (SELECT id FROM modele where nom like '%$val%'))");    
                    }
                    
                }
            }
            
            $req_site_add = $db->query("SELECT * FROM site");
            $req_pages = $db->query("SELECT * FROM page");
            $data_pages = $req_site->fetchAll();
            $data_site = $req_site_add->fetchAll();

?>
    <div class="container">
                <h1>Pages Sites</h1>
                <hr>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../accueil/index.php">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="../sites/index.php">Sites</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pages</li>
                    </ol>
                </nav>
                <form method="POST">
                    <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                        <input class="form-control me-1 ms-2" name="terme_page" type="search" placeholder="Recherche par nom du site, du modele ou de la page" aria-label="Search">
                        <input type="submit" name="search_page" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                    </div>
                </form>
                    <div class="w-50 ">
                            <div class="row g-3 justify-content-between">
                                <form method="POST">
                                <div class="col-auto mb-2">
                                    <input type="text" id="" class="form-control" name="nomPageAjouter" placeholder="Nom de la Page" required>
                                </div>
                                <select class="form-select mb-2" name="select_site" aria-label="Default select example">
                                    <option selected>Sites</option>
<?php
                                        foreach($data_site as $mod){
                                            $id_cli = $mod["client_id"];
                                            $req_cli = $db->query("SELECT * FROM client where id = '$id_cli'");
                                            $data_cli = $req_cli->fetch();
?>  
                                    <option value="<?=$mod["id"]?>"><?=$mod["nom"]?> | <?=$data_cli["societe"]?></option>
<?php
                                        }
?>
                                </select>
                                <input type="submit" value="Ajouter la page" name="add_page" class="bgSeed rounded-pill color_white border_white"/>
                            </form>
                            </div>
                    </div>
                <br><br>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Etat</th>
                                <th scope="col">Site</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Image(s)</th>
                                <th scope="col">Texte(s)</th>
                                <th scope="col">Rédaction</th>
                                <th></th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                                foreach ($data_pages as $page) {
                                    
                                    $id = $page["id"];
                                    $idM = $page['site_id'];
                                    $req_mod_appartient = $db->query("SELECT * FROM site where id = '$idM';");
                                    $req_nbImg = $db->query("SELECT * from image where page_id = '$id';");
                                    $req_nbTxt = $db->query("SELECT * from texte where page_id = '$id';");
                                    $nbImg = $req_nbImg->rowCount();
                                    $nbTxt = $req_nbTxt->rowCount();
                                    $site = $req_mod_appartient->fetch();
                                    $option = $db->query("SELECT * FROM avoiroption where page = '$id'")->fetch();
?>
                            <tr>
                                <th scope="row"><?php
                                if($nbImg==0 || $nbTxt==0){
                                ?>
                                <div class="alert alert-danger" role="alert">
                                ⚠
                                </div>
                                <?php
                                }else{
                                ?>
                                <div class="alert alert-success" role="alert">
                                ✓
                                </div>
<?php
                                }
?>
                                </th>
                                <td><?=$site["nom"]?></td>
                                <td><?=$page["nom"]?></td>
                                <td><?=$nbImg?></td>
                                <td><?=$nbTxt?></td>
                                <td><?php if(!empty($option)){echo "SeedWeb";}else{echo "Client";}?></td>
                                <td>
                                    <a class="dropdown-item actionAdmin" href="../images/index.php?page_id=<?=$page['id']?>">Voir les images 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                                        <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                        <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5V14zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4z"/>
                                    </svg>
                                    </a>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item actionAdmin sup_page" data_sup="<?=$page['id']?>">Supprimer</a></li>
                                            <li><a class="dropdown-item actionAdmin" href="../textes/index.php?page_id=<?=$page['id']?>">Voir les textes</a></li>
                                            <li><a class="dropdown-item actionAdmin add_option" info="<?php if(!empty($option)){echo "Supprimer la rédaction";}else{echo "Ajouter la rédaction";}?>" data_page='<?=$_GET['site_id']?>' data_sup="<?=$page['id']?>"><?php if(!empty($option)){echo "Supprimer la rédaction";}else{echo "Ajouter la rédaction";}?></a></li>
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
            function redi2(id){
                window.location = "index.php?site_id="+id;
            }

            </script>
<?php
    }else{

        header('Location: ../index.php');
    }
?>
<?php

if(isset($_POST["add_page"])){
    if(isset($_POST["nomPageAjouter"]) && !empty($_POST["nomPageAjouter"]) && $_POST["select_site"] != "Sites" ){
        $nom_page = $_POST["nomPageAjouter"];
        $idModele = $_POST["select_site"];
        $req_insert_page = $db->prepare("INSERT INTO page(site_id, nom) value ('$idModele','$nom_page')");
        $req_insert_page->execute();
        echo '<meta http-equiv="refresh" content="0">';
}
}

if(isset($_GET['id_add'])){
    $id_page = $_GET['id_add'];
    $add = $db->prepare("INSERT INTO avoiroption(page, idOption) value ('$id_page', 1)")->execute();
    $site = $_GET["site_id"];
    ?>
        <script>redi2("<?=$site?>")</script>
        <?php
}
if(isset($_GET["id_supp_redac"])){
    $id_page = $_GET["id_supp_redac"];
    $req_supp = $db->prepare("DELETE FROM avoiroption where page = '$id_page'")->execute();
    $site = $_GET["site_id"];
    ?>
        <script>redi2("<?=$site?>")</script>
        <?php
}

if(isset($_GET["id_page_supp"])){
    $id_supp = $_GET["id_page_supp"];
    $req_supp = $db->prepare("DELETE FROM page where id = '$id_supp'");
    $req_supp->execute();
    echo "<script>redi()</script>";
}
    }
    include("../includes/layout_bottom.php");
?>