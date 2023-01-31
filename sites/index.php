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
        <title>SeedWeb | Sites</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "admin"){
        $req_site = $db->query("SELECT * FROM site");
        if(isset($_POST["search_site"])){
            if(isset($_POST['terme_site'])){
                $val = $_POST['terme_site'];
                $req_site = $db->query("SELECT * FROM site where nom like '%$val%' or url like '%$val%' or client_id in (SELECT id from client where nom like '%$val%');");    
            }
        }
        $data_site = $req_site->fetchAll();
        $req_client_add = $db->query("SELECT * FROM client where role = 'client' and id not in (SELECT client_id from site);");
        $req_modele_add = $db->query("SELECT * FROM modele");
        $data_cli = $req_client_add->fetchAll();
        $data_modele = $req_modele_add->fetchAll();
?>
<div class="container">
            <h1>Sites</h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../accueil/index.php">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sites</li>
                </ol>
            </nav>
            <form method="POST">
                <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                    <input class="form-control me-1 ms-2" name="terme_site" type="search" placeholder="Rechercher un site" aria-label="Search">
                    <input type="submit" name="search_site" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                </div>
                <div class="w-50 ">
                    <form>
                        <div class="row g-3 justify-content-between">
                            <div class="col-auto">
                                <label for="" class="col-form-label">Nom</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="" class="form-control" name="nomSiteAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">URL</label>
                            </div>
                            <div class="col-auto float-end">
                                <input type="url" id="" class="form-control" name="urlSiteAjouter" aria-describedby="">
                            </div>
                            <select class="form-select col-auto" name="clientSiteAjouter" aria-label="Default select example">
                                <option value="-1" selected>Clients</option>
                                <?php
                                    foreach($data_cli as $cli){
                                ?>
                                <option value="<?=$cli['id']?>"><?=$cli["prenom"]?> <?=$cli["nom"]?> (<?=$cli["societe"]?>)</option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select class="form-select" name="modeleSiteAjouter" aria-label="Default select example">
                                <option selected>Modèles</option>
                                <?php
                                    foreach($data_modele as $mod){
                                ?>
                                <option value="<?=$mod["id"]?>"><?=$mod["nom"]?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Rédaction de contenu
                                </button>
                                <ul class="dropdown-menu">
                                    <li><div class="m-2 form-check">
                                        <input class="form-check-input" type="checkbox" name="accueil" value="0" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Accueil
                                        </label>
                                        </div>
                                    </li>
                                    <li>
                                    <div class="m-2 form-check">
                                        <input class="form-check-input" type="checkbox" name="qui-sommes-nous" value="0" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Qui sommes-nous
                                        </label>
                                    </div>
                                    </li>
                                    <li>
                                    <div class="m-2 form-check">
                                        <input class="form-check-input" type="checkbox" name="services" value="0" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Services
                                        </label>
                                    </div>
                                    </li>
                                    <li>
                                    <div class="m-2 form-check">
                                        <input class="form-check-input" type="checkbox" name="nous-contacter" value="0" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Nous contacter
                                        </label>
                                    </div>
                                    </li>
                                </ul>
                            </div>
                            <input type="submit" value="Ajouter le site" name="add_site" class="bgSeed rounded-pill color_white border_white"/>
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
                            <th scope="col">URL</th>
                            <th scope="col">Societe(Client)</th>
                            <th scope="col">Modèle</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($data_site as $site) {
                                $id_cli = $site["client_id"];
                                $id_modele = $site["modele_id"];
                                $req_client = $db->query("SELECT * FROM client Where id = '$id_cli'");
                                $req_modele = $db->query("SELECT * FROM modele where id = '$id_modele'");
                                $client = $req_client->fetch();
                                $modele = $req_modele->fetch();
                        ?>
                        <tr>
                            <th scope="row"><?=$site["id"]?></th>
                            <td><?=$site["nom"]?></td>
                            <td><?=$site["url"]?></td>
                            <td><?=$client['societe']?></td>
                            <td><?=$modele["nom"]?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item actionAdmin sup_site" data_sup="<?=$site['id']?>">Supprimer</a></li>
                                        <li><a class="dropdown-item actionAdmin" href="../pages-site/index.php?site_id=<?=$site['id']?>">Voir les pages</a></li>
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
?>
<?php
}}
    include("../includes/layout_bottom.php");

    if(isset($_POST["add_site"])){
        if(isset($_POST["nomSiteAjouter"]) && !empty($_POST["nomSiteAjouter"]) && isset($_POST["urlSiteAjouter"]) && !empty($_POST["urlSiteAjouter"]) && $_POST["clientSiteAjouter"] != "-1"){
            if(isset($_POST['accueil'])){
                $accueil = 1;
            }else{
                $accueil=0;
            }
            if(isset($_POST['qui-sommes-nous'])){
                $qsn = 1;
            }else{
                $qsn=0;
            }
            if(isset($_POST['services'])){
                $services = 1;
            }else{
                $services=0;
            }
            if(isset($_POST['nous-contacter'])){
                $nous_contacter = 1;
            }else{
                $nous_contacter=0;
            }
            $nom_site = addslashes($_POST["nomSiteAjouter"]);
            $idModele = $_POST["modeleSiteAjouter"];
            $idClient = $_POST["clientSiteAjouter"];
            $urlSite = $_POST["urlSiteAjouter"];
            $req_insert_site = $db->prepare("INSERT INTO site(client_id, modele_id, nom, url) value ('$idClient', '$idModele', '$nom_site', '$urlSite')");
            $req_insert_site->execute();
            $id_site_inserer = $db->lastInsertId();
            $req_insert_form = $db->prepare("INSERT INTO formulaire(id_client, progression, id_site, dateCreation, dateLastUpdate) value ('$idClient', 0, '$id_site_inserer', NOW(), NOW())");
            $req_insert_form->execute();
            $req_page_modele = $db->query("SELECT * FROM page_modele where id_modele = '$idModele'");
            $data_page_modele = $req_page_modele->fetchAll();
            foreach($data_page_modele as $page_modele){
                $nom_page = addslashes($page_modele["nom"]);
                $id_page = $page_modele["id_pageM"];
                $req_create_page_cli = $db->prepare("INSERT INTO page(site_id, nom) value ('$id_site_inserer', '$nom_page')");
                $req_create_page_cli->execute();
                $id_page_inserer = $db->lastInsertId();
                $copie_id_inserer = $id_page_inserer;
                $req_image_modele = $db->query("SELECT * FROM image_modele where id_pageM = '$id_page'");
                $req_texte_modele = $db->query("SELECT * FROM texte_modele where id_pageM = '$id_page'");
                $data_image_modele = $req_image_modele->fetchAll();
                $data_texte_modele = $req_texte_modele->fetchAll();
                if($nom_page == "Qui sommes-nous"){if($qsn==1){
                    $sql = $db->query("INSERT INTO avoiroption(page, idOption) value ('$id_page_inserer', 1)");
                }}
                if($nom_page == "Accueil"){if($accueil==1){
                    $sql = $db->query("INSERT INTO avoiroption(page, idOption) value ('$id_page_inserer', 1)");
                }}
                if($nom_page == "Services"){if($services==1){
                    $sql = $db->query("INSERT INTO avoiroption(page, idOption) value ('$id_page_inserer', 1)");
                }}
                if($nom_page == "Contact"){if($nous_contacter==1){
                    $sql = $db->query("INSERT INTO avoiroption(page, idOption) value ('$id_page_inserer', 1)");
                }}
                foreach($data_image_modele as $image){
                    $section = $image["id_section"];
                    $nom = addslashes($image["nom"]);
                    $description = addslashes($image["description"]);
                    $facultatif = $image["facultatif"];
                    $req_insert_image = $db->prepare("INSERT INTO image(section_id, page_id, nom, path, description, facultatif, alt) value ('$section','$id_page_inserer','$nom','','$description', '$facultatif', '')");
                    $req_insert_image->execute();
                }
                foreach($data_texte_modele as $texte){
                    $section = $texte["id_section"];
                    $nom = addslashes($texte["nom"]);
                    $taille = $texte["taille"];
                    $facultatif = $texte["facultatif"];
                    $req_insert_texte = $db->prepare("INSERT INTO texte(section_id, page_id, nom, contenu, taille, facultatif) value ('$section','$id_page_inserer','$nom','', '$taille','$facultatif')");
                    $req_insert_texte->execute();
                }
            }
            $data_cli_select = $db->query("SELECT * FROM client WHERE id='$idClient'");
            $data_cli_select = $data_cli_select->fetch();
            $nom = $data_cli_select['nom'];
            $prenom = $data_cli_select['prenom'];
            $societe = $data_cli_select['societe'];
            echo '<meta http-equiv="refresh" content="0">';

        }
    }

    if(isset($_GET["id_site_supp"])){
        $id_supp = $_GET["id_site_supp"];
        $req_supp = $db->prepare("DELETE FROM site where id = '$id_supp'");
        $req_supp->execute();
        echo "<script>redi()</script>";
    }


?>