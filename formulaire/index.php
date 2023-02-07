<?php
include("../config/config.php");
include("../config/dbconnection.php");
include_once('../sendMail.php');
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
        <link rel="stylesheet" href="../css/modal_flat.css" type="text/css" />
        <link rel="stylesheet" href="../css/modal_rounded.css" type="text/css" />
        <title>SeedWeb | Formulaire</title>
        <link rel="icon" href="../img/ico.png" />
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "admin"){
        $id = $_SESSION["id_client"];
        $req_formulaire = $db->query("SELECT * FROM notif where admin = '$id'");
        }
        $data_form = $req_formulaire->fetch();
?>
<div class="container">
    <h1>Notifications</h1>
    <hr>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../accueil/index.php">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
            </ol>
        </nav>
    <div class="w-25 mr-37-5 ml-37-5 p-3 border rounded">
        <form method="POST">
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="<?php if($data_form['page'] == 1){echo "1";}else{echo "0";}?>" name="page_check" id="flexCheckDefault" <?php if($data_form['page'] == 1){echo "checked";}?>>
                <label class="form-check-label" for="flexCheckDefault">
                    Par page
                </label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="<?php if($data_form['form'] == 1){echo "1";}else{echo "0";}?>" name="form_check" id="flexCheckChecked" <?php if($data_form['form'] == 1){echo "checked";}?>>
                <label class="form-check-label" for="flexCheckChecked">
                    Par formulaire
                </label>
            </div>
            <input type="submit" value="Valider mes préférences" name="notif" class="bgSeed rounded-pill color_white border_white"/>
        </form>
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
}
    if(isset($_POST['notif'])){
        if(!isset($_POST['page_check'])){
            $page = 0;
        }else{
            $page=1;
        }
        if(!isset($_POST['form_check'])){
            $form = 0;
        }else{
            $form=1;
        }
        $sql = $db->query("UPDATE notif set page='$page', form ='$form' where admin = '$id'");
        echo "<script>redi()</script>";
    }

    include("../includes/layout_bottom.php");
    
?>