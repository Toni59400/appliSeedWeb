<?php
include("./config/config.php");
include("./config/dbconnection.php");
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
        <link rel="stylesheet" href="./css/style.css">
        <title>SeedWeb | Connexion</title>
    </head>
    <?php
        include('includes/header.php');
    ?>
    <body class="text-center w-50 m-auto">
        <main class="form-signin w-50 m-auto mt-3">
        <form method="POST">
            <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
            <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="email">
            <label for="floatingInput">Login</label>
            </div>
            <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Mot de passe</label>
            </div>
            <button class="w-100 btnPerso bgSeed rounded-pill" type="submit" name="connexion">Connexion</button>
            <div class="alert-div"></div>
            <p class="mt-5 mb-3 text-muted">© SeedWeb 2023</p>
        </form>
        </main>

<?php
include("includes/layout_bottom.php");

if (isset($_POST['connexion'])){
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);

    $sql_client = "SELECT * FROM client WHERE mail = '$email' "; 
    
    $result_client = $db->prepare($sql_client);
   
    $result_client->execute();

    // C'est un client
    if ($result_client->rowCount() > 0){
        $data_client = $result_client-> fetchAll(); 
        if (password_verify($pass, $data_client[0]['pwd'])){
            $_SESSION['id_client'] = $data_client[0]['id'];
            $id = $_SESSION["id_client"];
            $sql = $db->prepare("UPDATE client set lastConnection = NOW() where id = '$id'");
            $sql->execute();
            if ($data_client[0]["role"] == "client"){
                $_SESSION['role'] = "client";
            } else {
                $_SESSION['role'] = "admin";
            }
            header("Location: accueil/index.php");
        }else {
            echo "Identifiant ou mot de passe incorrect.";
        }
    }
}


?>