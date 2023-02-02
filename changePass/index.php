<?php 
session_start();
include("../config/config.php");
include("../config/dbconnection.php");
include_once('../mailBuilder.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(!isset($_SESSION['theme'])){
    $_SESSION["theme"] = "light";
}
if(isset($_POST["dark"])){$_SESSION["theme"] = "dark";} if(isset($_POST["light"])){ $_SESSION["theme"] = "light";}

if (isset($_POST['recup'])){
    if (isset($_POST['email'])){
        mailPassLost($_POST['email']);
    }
} if (isset($_GET['cli'])){   
?>

<!DOCTYPE HTML>
<html lang="fr" data-bs-theme="<?=$_SESSION["theme"]?>">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>SeedWeb | ChangementMotDePasse </title>
    </head>
    <body class="text-center w-50 m-auto">
        <div class="container">
            <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                <div>
                    <a href="../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                    </a>
                </div>  
                <ul class="nav nav-pills">
                    <li class="nav-item color_seedWeb"><a href="https://seedweb.fr/" class="nav-link color_seedWeb">SeedWeb</a></li>
                </ul>
            </div>
        </div>
        <main class="form-signin w-50 m-auto mt-3">
            <form method="POST">
                <div class="form-floating mb-3">
                <input type="password" class="form-control" for="pass" id="floatingInput" name="pass">
                <label for="floatingInput">Mot de passe</label>
                </div>
                <div class="form-floating mb-3">
                <input type="password" class="form-control" for="pass" id="floatingInput" name="pass_confirm">
                <label for="floatingInput">Confirmer le mot de passe</label>
                </div>

                <button class="w-100 btnPerso bgSeed rounded-pill" type="submit" name="modif">Modifier le mot de passe</button>
            <p class="mt-5 mb-3 text-muted">© SeedWeb 2023</p>
            </form>
        </main>
    </body>


<?php 
include("../includes/layout_bottom.php");
} else {
?>
        <!DOCTYPE HTML>
<html lang="fr" data-bs-theme="<?=$_SESSION["theme"]?>">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>SeedWeb | ChangementMotDePasse </title>
    </head>
    <body class="text-center w-50 m-auto">
        <div class="container">
            <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                <div>
                    <a href="../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                    </a>
                </div>  
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="../" class="nav-link active bgSeed rounded-pill" aria-current="page">Connexion</a></li>
                    <li class="nav-item color_seedWeb"><a href="https://seedweb.fr/" class="nav-link color_seedWeb">SeedWeb</a></li>
                </ul>
            </div>
        </div>
        <main class="form-signin w-50 m-auto mt-3">
            <form method="POST">
                <div class="form-floating mb-3">
                <input type="mail" class="form-control" id="floatingInput" name="email" required>
                <label for="floatingInput">Email (associé au compte)</label>
                </div>
                <button class="w-100 btnPerso bgSeed rounded-pill" type="submit" name="recup">Envoyer un mail de récupération</button>
            <p class="mt-5 mb-3 text-muted">© SeedWeb 2023</p>
            </form>
        </main>
    </body>


<?php 
include("../includes/layout_bottom.php");
} if (isset($_POST['modif'])){
    if (isset($_POST['pass']) && isset($_POST["pass_confirm"])){
        if ($_POST['pass'] == $_POST['pass_confirm']){
            $email3 = $_GET['cli'];
            $mdp = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $sql = $db->prepare("UPDATE client set pwd = '$mdp' where mail = '$email3'"); 
            $sql -> execute();
            header("Location: ../index.php");
        }
    }
}
?>
