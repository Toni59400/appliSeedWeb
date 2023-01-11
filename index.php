<?php
session_start();
include("config/config.php");
include("config/dbconnection.php");
include("includes/layout.php");
?>
        <title>SeedWeb | Connexion</title>
    </head>
    <body class="text-center w-50 m-auto">
        <main class="form-signin w-50 m-auto mt-3">
        <form method="POST">
            <img class="mb-4" style="max-width: 100px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
            <h1 class="h3 mb-3 fw-normal">Veuillez vous connectez</h1>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="email">
            <label for="floatingInput">Login</label>
            </div>
            <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Mot de passe</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="connexion">Connexion</button>
            <div class="alert-div"></div>
            <p class="mt-5 mb-3 text-muted">© SeedWeb 2023</p>
        </form>
        </main>

<?php
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

include("includes/layout_bottom.php");
?>