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
        <title>SeedWeb | Mes Formulaires</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "client"){
        $nbTotalDeChamps = 0;
        $nbTotalDeChampsRemplis = 0;
        $id = $_SESSION["id_client"];
        $req_data_cli = $db->query("SELECT * FROM client where id = '$id'");
        $req_site = $db->query("SELECT * FROM site where client_id = '$id'");
        $data_site = $req_site->fetch();
        $id_site = $data_site["id"];
        $req_page = $db->query("SELECT * FROM page where site_id = '$id_site'");
        $data_page = $req_page->fetchAll();
        foreach($data_page as $page){
            $id_page = $page["id"];
            $req_section = $db->query("SELECT * FROM section");
            $data_section = $req_section->fetchAll();
            // $req_image = $db->query("SELECT * FROM image where page_id = '$id' order by section_id");
            // $req_texte = $db->query("SELECT * FROM texte where page_id = '$id' order by section_id");
            // $data_image = $req_image->fetchAll();
            // $data_texte = $req_texte->fetchAll();
            echo $page['nom'], $page['id'], "<br><br>";
            foreach($data_section as $section){
                echo $section["id"], $section["nom"], "<br>";
            }
        }
?>



<?php
}else{
?>
<h1>Pas d'autorisation pour accéder à cette page.</h1>
<?php
}}
    include("../includes/layout_bottom.php");
?>