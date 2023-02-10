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
        <title>SeedWeb | Textes Modèles</title>
        <link rel="icon" href="../img/ico.png" />
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");

    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == "admin"){
            if(isset($_GET["page_id"])){
                $id_page = $_GET["page_id"];
                $req = $db->query("SELECT * FROM texte_modele where id_pageM = '$id_page'");
                if(isset($_POST["search_texte"])){
                    if(isset($_POST['terme_modele'])){
                        $val = $_POST['terme_modele'];
                        $req = $db->query("SELECT * FROM texte_modele where id_pageM = '$id_page' and nom like '%$val%'");    
                    }
                }
                $req_data_modele = $db->query("SELECT * FROM modele where id in (SELECT id_modele from page_modele where id_pageM = '$id_page')");
                $req_data_page = $db->query("SELECT * FROM page_modele where id_pageM = '$id_page'");
                $req_setion = $db->query("SELECT * FROM section");
                $data_txt = $req->fetchAll();
                $data_modele = $req_data_modele->fetch();
                $data_page = $req_data_page->fetch();
                $data_section = $req_setion->fetchAll();
?>
<div class="container">
            <h1>Textes Modèles <?=$data_modele["nom"]?> - <?=$data_page["nom"]?></h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../accueil/index.php">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="../modeles/index.php">Modèles</a></li>
                    <li class="breadcrumb-item"><a href="../pages-modele/index.php">Pages Modèle</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Textes Modèle</li>
                </ol>
            </nav>
            <form method="POST">
                <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                    <input class="form-control me-1 ms-2" name="terme_modele" type="search" placeholder="Rechercher un texte" aria-label="Search">
                    <input type="submit" name="search_texte" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                </div>
            </form>
                <div class="w-50 ">
                    <div class="row g-3 justify-content-between">
                        <form method="POST">
                        <div class="col-auto mb-2">
                            <input type="text" id="" class="form-control" name="nomTexteAjouter" placeholder="Nom Texte" maxlength="35" required>
                        </div>
                        <select class="form-select mb-2" name="select_page" aria-label="Default select example">
                            <option selected value="<?=$data_page["id_pageM"]?>"><?=$data_page["nom"]?> - <?=$data_modele["nom"]?></option>
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
                            <input type="number" id="" max="1000" min="0" class="form-control" name="tailleTexteAjouter" placeholder="Nombre Caractere" required>
                        </div>
                        <select class="form-select mb-2" name="select_facultatif" aria-label="Default select example">
                            <option selected disabled="disabled" value="-1">Facultatif :</option>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <input type="submit" value="Ajouter le texte" name="add_texteM" class="bgSeed rounded-pill color_white border_white"/>
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
                                $id_section = $texte["id_section"];
                                $id_pag = $texte["id_pageM"];
                                $req2_setion = $db->query("SELECT * FROM section where id = '$id_section'");
                                $req2_page = $db->query("SELECT * FROM page_modele where id_pageM = '$id_pag'");
                                $data_section_texte = $req2_setion->fetch();
                                $data_page_texte = $req2_page->fetch();
                                $facultatif = "Oui";
                                if($texte['facultatif'] == false){
                                    $facultatif = "Non";
                                }
                        ?>
                        <tr>
                            <th scope="row"><?=$texte["id_texteM"]?></th>
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
                                        <li><a class="dropdown-item actionAdmin sup_texte" data_page="<?=$id_page?>" data_sup="<?=$texte['id_texteM']?>">Supprimer</a></li>
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
    }
}else{
        header('Location: ../index.php');
    }
?>

<?php
}
    include("../includes/layout_bottom.php");
    if(isset($_POST["add_texteM"])){
        if(isset($_POST["nomTexteAjouter"]) && !empty($_POST["nomTexteAjouter"]) && $_POST["select_section"] != "Section"){
            $nom_txt = addslashes($_POST["nomTexteAjouter"]);
            $idPage = $_POST["select_page"];
            $idSection = $_POST["select_section"];
            $taille = $_POST["tailleTexteAjouter"];
            $facultatif = $_POST["select_facultatif"];
            $req_insert_txt = $db->prepare("INSERT INTO texte_modele(nom, id_section, id_pageM, taille, facultatif) value ('$nom_txt', '$idSection', '$idPage', '$taille', '$facultatif')");
            $req_insert_txt->execute();
            echo '<meta http-equiv="refresh" content="0">';
    }
    }

    if(isset($_GET["id_texte_supp"])){
        $id_supp = $_GET["id_texte_supp"];
        $req_supp = $db->prepare("DELETE FROM texte_modele where id_texteM = '$id_supp'");
        $req_supp->execute();
        echo "<script>redi()</script>";
    }
?>