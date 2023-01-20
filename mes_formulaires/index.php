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
        $req_section = $db->query("SELECT * FROM section");
        $data_section = $req_section->fetchAll();
        $data_site = $req_site->fetch();
        $id_site = $data_site["id"];
        $id_modele = $data_site["modele_id"];
        $req_modele = $db->query("SELECT nom FROM modele where id = '$id_modele'");
        $data_modele = $req_modele->fetch();
        $req_page = $db->query("SELECT * FROM page where site_id = '$id_site'");
        $nbPageSiteClient = $req_page->rowCount();
        $data_page = $req_page->fetchAll();
        $nbEltParPage = 1;
        $nbTotalDePage = $nbPageSiteClient/$nbEltParPage;
        if(!isset($_GET['page'])){
            $_GET['page'] = 0;
        }
        $page = $data_page[$_GET["page"]];
        ?> 
        <form method="POST" action="" enctype='multipart/form-data'>
            <div  class="row w-100">
                <h1 class="text-center">Page : "<?=$page['nom']?>"</h1>
                <div class="position-relative"><input type="submit" name="save_page" value="Enregistrer" class="border_white color_white nav-link bgSeed rounded-pill w-25 position-absolute top-0 end-0"></div> <?php
        foreach($data_section as $section){
            $id_section = $section["id"];
            $id=$page["id"];
            $nom_section = $section['nom'];
            $req_image = $db->query("SELECT * FROM image where page_id = '$id' and section_id = '$id_section'");
            $req_texte = $db->query("SELECT * FROM texte where page_id = '$id' and section_id = '$id_section'");
            $data_image = $req_image->fetchAll();
            $data_texte = $req_texte->fetchAll();
            
            if(!empty($data_image) or !empty($data_texte)){
                $src_img = strtolower("../img/".$data_modele["nom"]. "_". $page["nom"]. "_". $section["nom"] . ".png");
                ?>
                <h2 class="text-center"><?=$nom_section?></h2>
                <div class="w-100 text-center">
                    <img src="<?=$src_img?>"  style="max-width: 40%; height: auto;" alt="Image_section_<?=$section["nom"]?>">
                </div>
                <div class="w-50 m-2 col">
                <?php
                foreach($data_image as $image){
                    $nomImg = $image['nom'];
                    $renseigne = !(empty($image["path"]));
                    $description = $image["description"];
                    $facultatif = "Non";
                    if($image['facultatif'] == true){$facultatif = "Oui";}
                    if($facultatif == "Non" && $renseigne == false){
                ?>
                    <div class="m-2">
                        <label for="formFileLg" class="form-label"><?php if(empty($description)){echo $nomImg;}else{echo $description;}; if($facultatif == "Non"){echo "<span class=\"text-danger-emphasis\">*</span>";}?></label>
                        <input class="form-control form-control-lg" id="formFileLg" idImage="<?=$image["id"]?>" name="<?=$nomImg?>" accept=".jpeg,.pdf,.png,.jpg,.svg,.webp,.gif" type="file" <?php if($facultatif == "Non"){echo "required";}?>/>
                    </div>
<?php
                    }
                }
?>
                </div>
                <div class="w-50 m-2 col" >
<?php
                
                foreach($data_texte as $texte){
                    $contenu = $texte["contenu"];
                    $nomTxt = $texte['nom'];
                    $renseigne_txt = !(empty($texte["contenu"]));
                    $facultatif_txt = "Non";
                    if($texte['facultatif'] == true){$facultatif_txt = "Oui";}
                    if($facultatif_txt == "Non" && $renseigne_txt == false){
                ?>
                    <div class="m-2">
                        <label for="" class="form-label"><?php echo $nomTxt; if($facultatif_txt == "Non"){echo "<span class=\"text-danger-emphasis\">*</span>";}?></label>
                        <input class="form-control form-control-lg input_counter" value="<?=$contenu?>" id="formFileLg" idTexte="<?=$texte["id"]?>" maxlength="<?=$texte["taille"]?>" name="<?=$nomTxt?>" type="text" <?php if($facultatif_txt == "Non"){echo "required";}?>>
                        <span class="counter badge bg-secondary" id="span_counter_input<?=$texte["id"]?>" ><?=$texte["taille"]?></span>
                        <span style="display: none;" class="badge bg-secondary " id="limite<?=$texte["id"]?>">Vous avez atteint la limite de caractères</span>
                    </div>

                <?php
                    }
            }
            ?>
                </div>
                
            <?php
        }
    }
?>  
                </div>
            </form>
            <div class="container" id="pagination">
                    <nav aria-label="Page Navigation">
                        <ul class="pagination justify-content-center">
                    <?php 
                        for ($i=1; $i<=$nbTotalDePage ; $i++) { 
                    ?>
                    
                    <li class="page-item"><a class="page-link" href="index.php?page=<?=$i-1?>"><?=$data_page[$i-1]["nom"]?></a></li>

                    <?php
                        }
                    ?>

                        </ul>
                    </nav>
            </div>
            <script>
                function popUpConfirm(texte){
                    DayPilot.Modal.alert(texte , { theme: "modal_flat" });
                }

            </script>

<?php


if(isset($_POST['save_page'])){
    $i = $_GET['page'];
    $page = $data_page[$i];
    foreach($data_section as $section){
        $id_section = $section["id"];
        $id=$page["id"];
        $nom_section = $section['nom'];
        $req_image = $db->query("SELECT * FROM image where page_id = '$id' and section_id = '$id_section'");
        $req_texte = $db->query("SELECT * FROM texte where page_id = '$id' and section_id = '$id_section'");
        $data_image = $req_image->fetchAll();
        $data_texte = $req_texte->fetchAll();
        $id_cli = $_SESSION["id_client"];
        $data_client = $db->query("SELECT * FROM client where id = '$id_cli'");
        $data_client = $data_client->fetch();
        if(!empty($data_image) or !empty($data_texte)){
            echo "1";
            foreach($data_image as $image){
                echo "2";
                var_dump($image["nom"]);
                $nom_img = $image["nom"];
                if(isset($_FILES[$nom_img])){
                    var_dump($_FILES);
                    //Pour le client concerner pour upload dans le fichier ensuite : 
                    $nom = $data_client["nom"];
                    $prenom = $data_client['prenom'];
                    $societe = $data_client["societe"];
                    // Pour le fichier (img) en question
                    $tmpName = $_FILES[$nom_img]["tmp_name"];
                    $name =  $_FILES[$nom_img]["name"];
                    $size =  $_FILES[$nom_img]["size"];
                    $error =  $_FILES[$nom_img]["error"];
                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                    $maxSize = 400000;
                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                    $path = "../dossier_client/" . $nom . "_" . $prenom . "_" . $societe . "/" . $page["nom"] ."/images/";
                    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        $path = "../dossier_client/" . $nom . "_" . $prenom . "_" . $societe . "/" . $page["nom"] . "/images/" . $nom_img . "." . $extension;
                        if (! move_uploaded_file($tmpName, $path)){
                            echo "ko";
                        } else { echo "ok";}
                    } else {
                        echo "ko";
                        echo "popUpConfirm('Un probleme est survenu pour :".$name."')"; 
                    }
                }
            }
            foreach($data_texte as $texte){

            }
        }
    }
}



}else{
?>
<h1>Pas d'autorisation pour accéder à cette page.</h1>
<?php
}}
    include("../includes/layout_bottom.php");

?>