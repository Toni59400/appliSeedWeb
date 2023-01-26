<?php
include("./config/config.php");
include("./config/dbconnection.php");
include("./includes/classMobile.php");
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(!isset($_SESSION['theme'])){
    $_SESSION["theme"] = "light";
    }
if(isset($_POST["dark"])){$_SESSION["theme"] = "dark";} if(isset($_POST["light"])){ $_SESSION["theme"] = "light";}
$detect = new Mobile_Detect();
if(!($detect->isMobile())){
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
        <script>function redi(){
            window.location = "accueil/index.php";
        }    
        </script>

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
            echo "<script>redi()</script>";
        }else {
            echo "Identifiant ou mot de passe incorrect.";
        }
    }
}
}else{
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
    <body>
        <div class="container">
            <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                <div>
                    <a href="../accueil/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                    </a>
                </div>  
            <ul class="nav nav-pills">
                <li class="nav-item color_seedWeb"><a href="https://seedweb.fr/" class="nav-link color_seedWeb">SeedWeb</a></li>
            </ul>
            </div>
        </div>
        <main class="form-signin w-50 m-auto mt-3 text-center">
            <div class="form-floating mb-3">
                <h1>Ce site n'est pas disponible sur mobile</h1>
            </div>
        </main>
    </body>
</html>
<?php
}


?>