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
        $data_cli = $req_data_cli->fetch();
        $data_admin = $db->query("SELECT * FROM client where role = 'admin'");
        $data_admin = $data_admin->fetchAll();
        $req_site = $db->query("SELECT * FROM site where client_id = '$id'");
        $req_section = $db->query("SELECT * FROM section");
        $data_section = $req_section->fetchAll();
        $data_site = $req_site->fetch();
        if(!empty($data_site)){
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
            <div  class="row w-75 mr-12-5 ml-12-5">
                <div class="col w-50">
                    <h1 class="text-center">Page : "<?=$page['nom']?>"</h1>
                    <div class="opacity-75">
                        <div class="m-2 text-center">
                            <input type="submit" name="save_state" value="Enregistrer l'avancement" class="p-2 border_white color_white nav-link bgSeed rounded-pill w-auto">
                        </div>
                        <div class="m-2 text-center">
                            <input type="submit" name="save_page" value="Valider la page" class="p-2 border_white color_white nav-link bgSeed rounded-pill w-auto">
                        </div>
                    </div>
                </div>
                
        <?php
        foreach($data_section as $section){
            $id_section = $section["id"];
            $id=$page["id"];
            $nom_section = $section['nom'];
            $data_option = $db->query("SELECT * FROM avoiroption where page = '$id' ")->fetch();
            $req_image = $db->query("SELECT * FROM image where page_id = '$id' and section_id = '$id_section' order by nom");
            $req_texte = $db->query("SELECT * FROM texte where page_id = '$id' and section_id = '$id_section' order by nom");
            $data_image = $req_image->fetchAll();
            $data_texte = $req_texte->fetchAll();
            
            if(!empty($data_image) or !empty($data_texte)){
                $array_space = array(" ");
                $nom_page = str_replace($array_space, "-", $page["nom"]);
                $nom_section2 = str_replace($array_space, "-", $section["nom"]);
                $src_img = strtolower("../img/".$data_modele["nom"]. "_". $nom_page . "_". $nom_section2 . ".png");
                ?>
                <h2 class="text-center"><?=$nom_section?></h2>
                <div class="w-100 text-center">
                    <img src="<?=$src_img?>"  style="max-width: 40%; height: auto;" alt="Image_section_<?=$section["nom"]?>">
                </div>
                <div class="w-50 m-2 col">
                <?php
                foreach($data_image as $image){
                    $nomImg = $image['nom'];
                    $alt = $image['alt'];
                    $renseigne = !(empty($image["path"]));
                    $description = $image["description"];
                    $facultatif = "Non";
                    if($image['facultatif'] == true){$facultatif = "Oui";}
                ?>
                <div class="m-4">
                <p class="text-start "><label for="formFileLg" class="form-label fw-bold"><?php if(empty($description)){echo $nomImg;}else{echo $description;}; if($facultatif == "Non"){echo "<span class=\"text-danger-emphasis\">*</span>";}else{echo "<span> (Facultatif)</span>";}?></label></p>
                    <div class="input-group">
                        <input class="form-control" title="" id="formFileLg" idImage="<?=$image["id"]?>" name="<?=$nomImg?>" accept=".jpeg,.pdf,.png,.jpg,.svg,.webp,.gif" type="file"/>
                        <input type="text" aria-label="Last name" name="<?=$nomImg?>-alt" maxlength="30" value="<?=$alt?>" placeholder="Description de l'image" class="form-control">
                    </div>
                </div>
<?php
                    }
?>
                </div>
                <div class="w-50 m-2 col" >
<?php
                
                foreach($data_texte as $texte){
                    $contenu = $texte["contenu"];
                    $array_space = array(" ");
                    $nomTxt2 = $texte["nom"];
                    $nomTxt = str_replace($array_space, "-", $texte['nom']);
                    $renseigne_txt = !(empty($texte["contenu"]));
                    $facultatif_txt = "Non";
                    if($texte['facultatif'] == true){$facultatif_txt = "Oui";}
                    if(!empty($data_option)){
?>
                    <div class="m-4">
                        <p class="text-start"><label for="" class="form-label fw-bold"></label></p>
                        <input class="form-control form-control-lg input_counter" value="Texte compris dans votre option" id="formFileLg"  idTexte="<?=$texte["id"]?>" maxlength="31" minlength="31" name="<?=$nomTxt?>" type="text" readonly>
                    </div>

                        <?php
                    } else{
                    if($texte["taille"] < 100){
                ?>

                    <div class="m-4">
                        <p class="text-start "><label for="" class="form-label fw-bold"><?php echo $nomTxt2; if($facultatif_txt == "Non"){echo "<span class=\"text-danger-emphasis\">*</span>";}else{echo "<span>(Facultatif)</span>";}?></label></p>
                        <input class="form-control form-control-lg input_counter" value="<?=$contenu?>" id="formFileLg" idTexte="<?=$texte["id"]?>" maxlength="<?=$texte["taille"]?>" name="<?=$nomTxt?>" type="text" >
                        <span class="counter badge bg-secondary" id="span_counter_input<?=$texte["id"]?>" ><?=$texte["taille"]?> caractères restants</span>
                        <span style="display: none;" class="badge bg-secondary " id="limite<?=$texte["id"]?>">Vous avez atteint la limite de caractères</span>
                    </div>

                <?php
                    } else {
                ?>
                    <div class="m-2">
                        <p class="text-start "><label class="form-label fw-bold"><?php echo $nomTxt2; if($facultatif_txt == "Non"){echo "<span class=\"text-danger-emphasis\">*</span>";}else{echo "<span>(Facultatif)</span>";}?></label></p>
                        <textarea class="form-control input_counter" idTexte="<?=$texte["id"]?>" maxlength="<?=$texte["taille"]?>" name="<?=$nomTxt?>" id="floatingTextarea"><?=$contenu?></textarea>
                        <span class="counter badge bg-secondary" id="span_counter_input<?=$texte["id"]?>" ><?=$texte["taille"]?> caractères restants</span>
                        <span style="display: none;" class="badge bg-secondary " id="limite<?=$texte["id"]?>">Vous avez atteint la limite de caractères</span>
                    </div>

                <?php
                    }
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
            <div class="container fixed-bottom opacity-75" id="pagination">
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
            <script src="../script/daypilot-modal-3.15.1.min.js"></script>
            <script>
            function messError(test){
                DayPilot.Modal.alert(test)
                .then(function(args) {
                    if (args.canceled) {
                    }
                    else {
                        window.location = "index.php?page=<?=$_GET['page']?>";
                    }
                });
            }
            
            function redi(){
                window.location = "index.php?page=<?=$_GET['page']?>";
            }

            function message(texte){
                DayPilot.Modal.alert(texte)
                .then(function(args) {
                    if (args.canceled) {
                    }
                    else {
                        window.location = "index.php?page=<?=$_GET['page']?>";
                    }
                });
        }
        </script>

<?php
if(isset($_POST["save_state"])){
    $allChamps = 0;
    $checkChamps = 0;
    $pages = $db->query("SELECT * FROM page WHERE site_id = '$id_site'")->fetchAll();
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
            foreach($data_image as $image){
                $id_img = $image["id"];
                $nom_img = $image["nom"];
                if(isset($_FILES[$nom_img]) && !empty($_FILES[$nom_img]["name"])){
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
                    $maxSize = 600000;
                    $extensions = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
                    $path = "../dossier_client/" . $nom . "_" . $prenom . "/" . $page["nom"] ."/images/";
                    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        $path = "../dossier_client/" . $nom . "_" . $prenom . "/" . $page["nom"] . "/images/" . $nom_img . "." . $extension;
                        if(move_uploaded_file($tmpName, $path)){
                            $alt = "";
                            if(isset($_POST[$image['nom'].'-alt'])){
                                $alt=$_POST[$image['nom'].'-alt'];
                            }
                            $req_update_img = $db->prepare("UPDATE image SET path = '$path', facultatif = true, alt = '$alt' where id = '$id_img'");
                            $req_update_img->execute();
                        }
                    }
                }
            }
            //Enregistrement des textes 
            foreach($data_texte as $texte){
                $array_space = array(" ");
                $nomTxt = str_replace($array_space, "-", $texte['nom']);
                $id_texte = $texte['id'];
                if(isset($_POST[$nomTxt]) && !empty($_POST[$nomTxt])){
                    $contenu = addslashes($_POST[$nomTxt]);
                    $req_txt = $db->prepare("UPDATE texte SET contenu = '$contenu', facultatif = true where id = '$id_texte'");
                    $req_txt = $req_txt->execute();
                } if(empty($_POST[$nomTxt]) && $texte['contenu']!= ""){
                    $req_txt = $db->prepare("UPDATE texte SET contenu = '', facultatif = false where id = '$id_texte'");
                    $req_txt = $req_txt->execute();
                }
            }
        }
    }
    //parcours de tous les champs pour visualiser l'avancement du formulaire
    foreach($pages as $p){
        $idP = $p["id"];
        foreach($data_section as $section){
            $id_section = $section["id"];
            $req_image2 = $db->query("SELECT * FROM image where section_id = '$id_section' and page_id = '$idP'");
            $req_texte2 = $db->query("SELECT * FROM texte where section_id = '$id_section' and page_id = '$idP'");
            $data_image2 = $req_image2->fetchAll();
            $data_texte2 = $req_texte2->fetchAll();
            if(!empty($data_image2) or !empty($data_texte2)){
                foreach($data_image2 as $image2){
                    $allChamps ++;
                    $nom_img = $image2["nom"];
                    if($image2["path"] != ""){$checkChamps ++;}
                }
                foreach($data_texte2 as $texte2){
                    $allChamps ++;
                    $nomTxt = $texte2["nom"];
                    if($texte2["contenu"] != ""){$checkChamps ++;}
                }
            }
        }
    }
    $pourcentage=intval($checkChamps*100/$allChamps);
    $req_form = $db->prepare("UPDATE formulaire SET progression='$pourcentage', dateLastUpdate=NOW() where id_client = $id_cli and id_site='$id_site'");
    $req_form->execute();

    $mess = "Enregistrement effectué. Vous pouvez modifier les images en les ajoutant à nouveau. Vous avez complété ".$pourcentage."% du formulaire.";
    if($pourcentage>=100){
        $mess = "Formulaire validé.";
        $sujet = "Validation du formulaire";
            $message = '
                    <html>
                        <head>
                            <title>'.$data_cli['societe'].' a validé son formulaire.</title>
                        </head>
                        <body>
                            <p>'.$data_cli['societe'].' vient de terminer son formulaire !"</p>
                        </body>
                    </html>
                    ';
            foreach($data_admin as $ad){
                $idAd = $ad["id"];
                $data_notif = $db->query("SELECT * FROM notif where admin = '$idAd'")->fetch();
                if($data_notif["page"] == true){
                    $email = $ad['mail'];
                    sendMail($sujet, $message, $email);
                }
            }
    }
    ?>
    <script>message("<?=$mess?>")</script>
    <?php
}

if(isset($_POST['save_page'])){
    $allChamps = 0;
    $checkChamps = 0;
    $nbError=0;
    $error = array();
    $i = $_GET['page'];
    $pages = $db->query("SELECT * FROM page WHERE site_id = '$id_site'")->fetchAll();
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
            foreach($data_image as $image){
                $id_img = $image["id"];
                $nom_img = $image["nom"];
                if(isset($_FILES[$nom_img]) && !empty($_FILES[$nom_img]["name"])){
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
                    $maxSize = 600000;
                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                    $path = "../dossier_client/" . $nom . "_" . $prenom . "/" . $page["nom"] ."/images/";
                    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        $path = "../dossier_client/" . $nom . "_" . $prenom . "/" . $page["nom"] . "/images/" . $nom_img . "." . $extension;
                        if(move_uploaded_file($tmpName, $path)){
                            $alt = "";
                            if(isset($_POST[$image['nom'].'-alt'])){
                                $alt=$_POST[$image['nom'].'-alt'];
                            }
                            $req_update_img = $db->prepare("UPDATE image SET path = '$path', facultatif = true, alt='$alt' where id = '$id_img'");
                            $req_update_img->execute();
                        }
                    }
                } else {
                    if($image["facultatif"] == false){
                        $nbError = $nbError +1;
                    }
                }
            }
            foreach($data_texte as $texte){
                $array_space = array(" ");
                $nomTxt = str_replace($array_space, "-", $texte['nom']);
                $id_texte = $texte['id'];
                if(isset($_POST[$nomTxt]) && !empty($_POST[$nomTxt])){
                    $contenu = addslashes($_POST[$nomTxt]);
                    $req_txt = $db->prepare("UPDATE texte SET contenu = '$contenu', facultatif = true where id = '$id_texte'");
                    $req_txt = $req_txt->execute();
                } else {
                    if($texte["facultatif"] != true){
                        $nbError ++;
                    }
                }
            }
        }
        foreach($pages as $p){
            $idP = $p["id"];
            foreach($data_section as $section){
                $id_section = $section["id"];
                $req_image2 = $db->query("SELECT * FROM image where section_id = '$id_section' and page_id = '$idP'");
                $req_texte2 = $db->query("SELECT * FROM texte where section_id = '$id_section' and page_id = '$idP'");
                $data_image2 = $req_image2->fetchAll();
                $data_texte2 = $req_texte2->fetchAll();
                if(!empty($data_image2) or !empty($data_texte2)){
                    foreach($data_image2 as $image2){
                        $allChamps ++;
                        $nom_img = $image2["nom"];
                        if($image2["path"] != ""){$checkChamps ++;}
                    }
                    foreach($data_texte2 as $texte2){
                        $allChamps ++;
                        $nomTxt = $texte2["nom"];
                        if($texte2["contenu"] != ""){$checkChamps ++;}
                    }
                }
            }
        }
        $pourcentage=intval($checkChamps*100/$allChamps);
        $req_form = $db->prepare("UPDATE formulaire SET progression='$pourcentage', dateLastUpdate=NOW() where id_client = $id_cli and id_site='$id_site'");
        $req_form->execute();
    }
    //echo '<meta http-equiv="refresh" content="1">';
    if($nbError!=0){
        $texte = strval($nbError)." Champ(s) necessaires manquants";
        ?>
        <script>messError("<?=$texte?>")</script>
        <?php
    } else {
        
        $i = $_GET['page'];
        $mess = "Page validée.";
        $sujet = "Validation de page";
            $message = '
                    <html>
                        <head>
                            <title>'.$data_cli['societe'].' a validé une page de son formulaire.</title>
                        </head>
                        <body>
                            <p>'.$data_cli['societe'].' vient de valider la page "'.$data_page[$i]['nom'].'" sur son formulaire !"</p>
                        </body>
                    </html>
                    ';
            foreach($data_admin as $ad){
                $idAd = $ad["id"];
                $data_notif = $db->query("SELECT * FROM notif where admin = '$idAd'")->fetch();
                if($data_notif["page"] == true){
                    $email = $ad['mail'];
                    sendMail($sujet, $message, $email);
                }
            }
        ?>
        <script>message("<?=$mess?>")</script>
        <?php
    }
}



}else{
?>
<h1>Pas encore de site</h1>
<?php
}}else{
?>
<h1>Pas d'autorisation pour accéder à cette page.</h1>
<?php
}}
    include("../includes/layout_bottom.php");
?>