<?php
include("../config/config.php");
include("../config/dbconnection.php");
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!DOCTYPE HTML>
<html lang="fr">
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
            <form method="POST">
                <div class="d-flex justify-content-end w-50 float-end mb-3 mt-3 ">
                    <input class="form-control me-1 ms-2" name="terme_cli" type="search" placeholder="Rechercher un client" aria-label="Search">
                    <input type="submit" name="search_cli" class="bgSeed rounded-pill color_white border_white" value="Rechercher">
                </div>
                <div class="w-50 ">
                    <form>
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
                                <input type="text" id="" placeholder="Login" class="form-control" name="identifiantClientAjouter" aria-describedby="">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Password</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="" placeholder="Password"  class="form-control" name="passClientAjouter" aria-describedby="">
                            </div>
                            <input type="submit" value="Ajouter le client" class="bgSeed rounded-pill color_white border_white"/>
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
                            <td><span class="sup_client actionAdmin" data_sup="<?=$client['id']?>">Supprimer</span></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>




<?php
}else{
?>
<h1>Pas d'autorisation pour accéder à cette page.</h1>
<?php
}}

    
    include("../includes/layout_bottom.php");
?>