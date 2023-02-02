<?php
include("../config/config.php");
include("../config/dbconnection.php");
include("../mailBuilder.php");
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
        <title>SeedWeb | Textes </title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");

    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == "admin"){
            if(isset($_GET["page_id"])){
                $id_page = $_GET["page_id"];
                $req = $db->query("SELECT * FROM texte where page_id = '$id_page'");
                if(isset($_POST["search_texte"])){
                    if(isset($_POST['terme_modele'])){
                        $val = $_POST['terme_modele'];
                        $req = $db->query("SELECT * FROM texte where page_id = '$id_page' and nom like '%$val%'");    
                    }
                }
                $req_data_modele = $db->query("SELECT * FROM site where id in (SELECT site_id from page where id = '$id_page')");
                $req_data_page = $db->query("SELECT * FROM page where id = '$id_page'");
                $req_setion = $db->query("SELECT * FROM section");
                $data_txt = $req->fetchAll();
                $data_site = $req_data_modele->fetch();
                $data_page = $req_data_page->fetch();
                $data_section = $req_setion->fetchAll();
                $idSite = $data_site["id"];
                $data_cli = $db->query("SELECT * FROM client where id in (SELECT client_id from site where id = '$idSite')")->fetch();
?>
<div class="container">
            <h1>Textes  <?=$data_site["nom"]?> - <?=$data_page["nom"]?></h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../accueil/index.php">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="../sites/index.php">Sites</a></li>
                    <li class="breadcrumb-item"><a href="../pages-site/index.php?site_id=<?=$data_site["id"]?>">Pages</a></li>
                    <li class="breadcrumb-item"><a href="../images/index.php?page_id=<?=$data_page["id"]?>">Images</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Textes</li>
                </ol>
            </nav>
            <form method="POST">
                <div class="d-flex justify-content-end w-50 float-end mb-3 ">
                    <input class="form-control me-1 ms-2" name="terme_modele" type="search" placeholder="Rechercher un texte" aria-label="Search">
                    <input type="submit" name="search_texte" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                </div>
            </form>
                <div class="w-50 ">
                    <div class="row g-3 justify-content-between">
                        <form method="POST">
                        <div class="col-auto mb-2 w-100">
                            <input type="text" id="" class="form-control" name="nomTexteAjouter" placeholder="Nom Texte" required>
                        </div>
                        <select class="form-select mb-2" name="select_page" aria-label="Default select example">
                            <option selected disabled="disabled" value="<?=$data_page["id"]?>"><?=$data_page["nom"]?> - <?=$data_site["nom"]?></option>
                        </select>
                        <select class="form-select mb-2" name="select_section" aria-label="Default select example">
                                    <option selected>Section</option>
<?php
                                        foreach($data_section as $section){
?>
                                    <option value="<?=$section["id"]?>"><?=$section["nom"]?></option>
<?php
                                        }
?>
                        </select>
                        <div class="col-auto mb-2 w-100">
                            <input type="number" id="" max="500" min="0" class="form-control" name="tailleTexteAjouter" placeholder="Nombre Caractere" required>
                        </div>
                        <select class="form-select mb-2" name="select_facultatif" aria-label="Default select example">
                            <option selected disabled="disabled" value="-1">Facultatif :</option>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <input type="submit" value="Ajouter le texte" name="add_texte" class="bgSeed rounded-pill color_white border_white"/>
                        </form>
                        <span class=" btn_envoi_form bgSeed rounded-pill color_white border_white cursorP" data_page="<?=$_GET['page_id']?>" data_cli="<?=$data_cli["mail"]?>">Envoi du formulaire 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                            </svg>
                        </span>
                    </div>
                </div>
            <br><br>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Section</th>
                            <th scope="col">Page</th>
                            <th scope="col">Taille</th>
                            <th scope="col">Facultatif</th>
                            <th scope="col">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($data_txt as $texte) {
                                $id_section = $texte["section_id"];
                                $id_pag = $texte["page_id"];
                                $req2_setion = $db->query("SELECT * FROM section where id = '$id_section'");
                                $req2_page = $db->query("SELECT * FROM page where id = '$id_pag'");
                                $data_section_texte = $req2_setion->fetch();
                                $data_page_texte = $req2_page->fetch();
                                $facultatif = "Oui";
                                if($texte['facultatif'] == false){
                                    $facultatif = "Non";
                                }
                        ?>
                        <tr>
                            <th scope="row"><?=$texte["id"]?></th>
                            <td><?=$texte["nom"]?></td>
                            <td><?=$data_section_texte["nom"]?></td>
                            <td><?=$data_page_texte["nom"]?></td>
                            <td><?=$texte["taille"]?> caractères</td>
                            <td><?=$facultatif?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item actionAdmin sup_texte" data_page="<?=$id_page?>" data_sup="<?=$texte['id']?>">Supprimer</a></li>
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
                window.location = "index.php?page_id=<?=$id_page?>";
            }
        </script>
<?php
    if(isset($_GET["send_form"])){
        $nom = $data_cli["nom"];
        $prenom = $data_cli["prenom"];
        $site = $data_site["url"];
        $mail = $_GET["send_form"];
        formReady($nom, $prenom, $site, $mail);
    }


}
}else{
        header('Location: ../index.php');
    }
?>

<?php
}
    include("../includes/layout_bottom.php");
    if(isset($_POST["add_texte"])){
        if(isset($_POST["nomTexteAjouter"]) && !empty($_POST["nomTexteAjouter"]) && isset($_POST["select_section"]) && !empty($_POST["select_section"])){
            $nom_txt = addslashes($_POST["nomTexteAjouter"]);
            $idPage = $_GET["page_id"];
            $idSection = $_POST["select_section"];
            $facultatif = $_POST["select_facultatif"];
            $taille = $_POST["tailleTexteAjouter"];
            $req_insert_txt = $db->prepare("INSERT INTO texte(section_id, page_id, nom, contenu, taille, facultatif) value ('$idSection', '$idPage', '$nom_txt', '', '$taille', '$facultatif')");
            $req_insert_txt->execute();
            echo '<meta http-equiv="refresh" content="0">';
    }
    }

    if(isset($_GET["id_texte_supp"])){
        $id_supp = $_GET["id_texte_supp"];
        $req_supp = $db->prepare("DELETE FROM texte where id = '$id_supp'");
        $req_supp->execute();
        echo "<script>redi()</script>";
    }
?>