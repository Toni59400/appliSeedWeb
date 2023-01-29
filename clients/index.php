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
        <title>SeedWeb | Clients</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "admin"){
        $req_client = $db->query("SELECT * FROM client where role = 'client';");
        if(isset($_POST["search_cli"])){
            if(isset($_POST['terme_cli'])){
                $val = $_POST['terme_cli'];
                $req_client = $db->query("SELECT * FROM (SELECT * FROM client where role = 'client') as Cli where Cli.nom like '%$val%' or Cli.prenom like '%$val%' or Cli.adresse like '%$val%' or Cli.societe like '%$val%' or Cli.mail like '%$val%'");    
            }
        }
        $data_cli = $req_client->fetchAll();
?>
        <div class="container">
            <h1>Clients</h1>
            <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../accueil/index.php">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clients</li>
                </ol>
            </nav>
            <form method="POST">
                <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                    <input class="form-control me-1 ms-2" name="terme_cli" type="search" placeholder="Rechercher un client" aria-label="Search">
                    <input type="submit" name="search_cli" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                </div>
                <div class="w-50 ">
                    <form method="POST">
                        <div class="row g-3 justify-content-between">
                            <div class="col-auto">
                                <label for="" class="col-form-label">Nom</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="" class="form-control" name="nomClientAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Prenom</label>
                            </div>
                            <div class="col-auto float-end">
                                <input type="text" id="" class="form-control" name="prenomClientAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Adresse</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="" placeholder="8 rue de Paris 62000 Arras" class="form-control" name="adresseClientAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Societe</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="" placeholder="SeedWeb" class="form-control" name="societeClientAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Identifiant</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="" placeholder="Login" class="form-control" for="email" name="identifiantClientAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Password</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="" placeholder="Password"  class="form-control" name="passClientAjouter" aria-describedby="">
                            </div>
                            <input type="submit" value="Ajouter le client" name="addCli" class="bgSeed rounded-pill color_white border_white"/>
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
                            <th scope="col">Prenom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Societe</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($data_cli as $client) {
                                $id_cli = $client["id"];
                                $reqSite = $db->prepare("SELECT count(*) from site where client_id = '$id_cli';");
                                $nbSite = $reqSite->fetch();
                        ?>
                        <tr>
                            <th scope="row"><?=$client["id"]?></th>
                            <td><?=$client["nom"]?></td>
                            <td><?=$client["adresse"]?></td>
                            <td><?=$client["societe"]?></td>
                            <td><?=$client["mail"]?></td>
                            <td>
                            <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item actionAdmin sup_client" data_sup="<?=$client['id']?>">Supprimer</a></li>
                                        <li><a class="dropdown-item actionAdmin" href="./index.php?relance=<?=$client['id']?>">Envoyer une relance</a></li>
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
        <script>
        function message(texte, id){
                DayPilot.Modal.alert(texte, {okText:"Oui", cancelText:"Annuler"})
                .then(function(args) {
                    if (args.canceled) {
                    }
                    else {
                        window.location = "index.php?confirm="+id;
                    }
                });
            }
        
        function redi(){
                window.location = "index.php";
            }
        </script>
<?php
}else{
    header("Location: ../index.php");
?>
<?php
}}
    
    include("../includes/layout_bottom.php");

    if(isset($_POST['addCli'])){
        if(isset($_POST["nomClientAjouter"]) && !empty($_POST["nomClientAjouter"]) && isset($_POST["prenomClientAjouter"]) && !empty($_POST["prenomClientAjouter"]) && isset($_POST["adresseClientAjouter"]) && !empty($_POST["adresseClientAjouter"]) && isset($_POST["societeClientAjouter"]) && !empty($_POST["societeClientAjouter"]) && isset($_POST["identifiantClientAjouter"]) && !empty($_POST["identifiantClientAjouter"]) && isset($_POST["passClientAjouter"]) && !empty($_POST["passClientAjouter"])){
            $nom = htmlspecialchars($_POST["nomClientAjouter"]);
            $prenom = htmlspecialchars($_POST["prenomClientAjouter"]);
            $adresse = htmlspecialchars($_POST["adresseClientAjouter"]);
            $societe = htmlspecialchars($_POST["societeClientAjouter"]);
            $identifiant = htmlspecialchars($_POST["identifiantClientAjouter"]);
            $pass = password_hash(htmlspecialchars($_POST["passClientAjouter"]), PASSWORD_DEFAULT);
            $req_insertClient = $db->prepare("INSERT INTO client(role, nom, prenom, adresse, societe, mail, pwd, lastConnection) value ('client', '$nom', '$prenom', '$adresse', '$societe', '$identifiant', '$pass', NOW())");
            $req_insertClient->execute();
            $nom_dossier = "../dossier_client/" . $nom . "_" . $prenom . "_" . $societe;
            if (!file_exists($nom_dossier)) {
                mkdir($nom_dossier, 0777, true);
            }
            echo '<meta http-equiv="refresh" content="0">';
        }
    }

    if(isset($_GET["id_cli_supp"])){
        $id_supp = $_GET["id_cli_supp"];
        $req_supp = $db->prepare("DELETE FROM client where id = '$id_supp'");
        $req_supp->execute();
        echo "<script>redi()</script>";
    }

    if (isset($_GET["relance"])){
        $id = $_GET["relance"];
        $mess="Voulez-vous envoyer l'email ?";
        ?>
        <script>message("<?=$mess?>", "<?=$id?>")</script>
        <?php
    }
    if(isset($_GET["confirm"])){
        $id = $_GET["confirm"];
        $data_cli = $db->query("SELECT * FROM client where id='$id'");
        $data_cli = $data_cli->fetch();
        $sujet = "Relance pour compléter le formulaire";
            $message = '
                    <html>
                        <head>
                            <title>Veuillez remplir votre formulaire</title>
                        </head>
                        <body>
                            <p>SeedWebAppli vous invite à remplir votre formulaire concernant votre Site, se trouvant dans votre espace personnel > Mon Formulaire.</p> <br> <p>Merci à vous!</p>
                    </html>
                    ';
        sendMail($sujet, $message, $data_cli["mail"]);
        echo "<script>redi()</script>";
    }
    
?>