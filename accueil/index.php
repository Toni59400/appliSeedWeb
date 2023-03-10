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
        <link rel="icon" href="../img/ico.png" />
        <title>SeedWeb | Accueil</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "client"){
        $id = $_SESSION['id_client'];
        $data_cli = $db->query("SELECT * FROM client where id='$id'")->fetch();
        $data_formulaire = $db->query("SELECT * FROM formulaire where id_client = '$id'")->fetch();
        $data_site = $db->query("SELECT * FROM site where client_id = '$id'")->fetch();
        $idSite = $data_site["id"];
        $dataPage = $db->query("SELECT * FROM page where site_id='$idSite'")->fetchAll();
        $nbErr = 0;
        $NbPage = $db->query("SELECT * from page where site_id = '$idSite'")->rowCount();
        $NbPageOk = $db->query("SELECT * from page where site_id = '$idSite' and page.id in (select page from pagevalide)")->rowCount();
        foreach($dataPage as $page){
            $idP = $page["id"];
            $nbErrTexte = $db->query("SELECT * from erreurt where id_texte in (SELECT id FROM texte where page_id = '$idP') and finish=0")->rowCount();
            $nbErrImage = $db->query("SELECT * from erreur where id_image in (SELECT id FROM image where page_id = '$idP') and finish=0")->rowCount();
            $nbErr+= $nbErrImage+$nbErrTexte;
        }
        if(!empty($data_formulaire)){
?>

<div class="w-50 mr-25 ml-25">
    
    <?php if($data_formulaire["progression"] == 0){?>
        <p class="fw-bold">Vous n'avez pas encore commenc?? ?? remplir votre formulaire</p>
        <a href="../mes_formulaires/"><p class="fw-bold btn btn-outline-seed">Cliquez-ici pour le commencer !</p></a>
    <?php }if(($data_formulaire["progression"] > 0 && $data_formulaire["progression"] < 100) || ($NbPage != $NbPageOk) && $data_formulaire["progression"] != 0){?>
    <p class="fw-bold">Avancement de votre formulaire: 
<?php if($nbErr>0){?>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgb(255,1,1)" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Le formulaire comporte <?=$nbErr?> erreur(s)" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
<?php }?>
    </p>
    <div class="meter seed">
        <span style="width: <?=$data_formulaire['progression']?>%" class="text-black"><?=$data_formulaire['progression']?>%</span>
    </div>
    <a href="../mes_formulaires/"><p class="fw-bold btn btn-outline-seed">Cliquez-ici pour le compl??ter !</p></a>
    <?php }elseif($NbPage == $NbPageOk){ ?>

        <p class="fw-bold">Votre formulaire est enti??rement compl??t??</p>
    

<?php }} ?>


</div>

<?php
    } if($_SESSION['role'] == "admin"){
        $nbForm = $db->query("SELECT * FROM formulaire")->rowCount();
        $nbFormStart = $db->query("SELECT * FROM formulaire WHERE progression != 0")->rowCount();
        $nbFormFinish = $db->query("SELECT * FROM formulaire WHERE progression >= 100")->rowCount();
        $avgForm = $db->query("SELECT round(avg(progression), 2) as moyenne from formulaire")->fetch();
        $modele = $db->query('SELECT * FROM modele');
        ?>
<div class="w-50 mr-25 ml-25 ">
    <div class="card-group row-cols-1 row-cols-md-3">
        <div class="col">
            <div class="card m-4 rounded" style="width: 18rem;">
                <span class="fs-1"><?=$nbForm?></span>
                <div class="card-body">
                    <p class="card-text">Formulaires g??n??r??s</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card m-4 rounded border" style="width: 18rem;">
                <span class="fs-1"><?=$nbFormStart?></span>
                <div class="card-body">
                    <p class="card-text">Formulaires en cours - Client</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card m-4 rounded border" style="width: 18rem;">
                <span class="fs-1"><?=$nbFormFinish?></span>
                <div class="card-body">
                    <p class="card-text">Formulaires termin??s</p>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Mod??le</th>
            <th scope="col">Nombre de site</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($modele as $m){
                    $id = $m["id"];
                    $nbSite = $db->query("SELECT * FROM site WHERE modele_id = '$id'")->rowCount();
            ?>
            <tr>
                <th scope="row"><?=$m['nom']?></th>
                <td><?=$nbSite?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <br>
    <hr>
    <div>
        <p class="fw-bold">Remplissage moyen des formulaires</p>
        <div class="meter seed">
            <span style="width: <?=$avgForm["moyenne"]?>%" class="text-black"><?=$avgForm["moyenne"]?>%</span>
        </div>
    </div>
</div>


<?php
    }
    }
    include("../includes/layout_bottom.php");
?>