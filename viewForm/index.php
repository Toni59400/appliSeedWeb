<?php
include("../config/config.php");
include("../config/dbconnection.php");
include("../mailBuilder.php");
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
        <title>SeedWeb | Récupération Données</title>
    </head>
    <body class="text-center w-100 m-auto">
        
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "admin"){
        if(isset($_GET["site_id"])){
            $idSite = $_GET['site_id'];
            $dataSite = $db->query("SELECT * FROM SITE WHERE ID = '$idSite'")->fetch();
            $nbPageSiteClient = $db->query("SELECT * FROM page WHERE site_id = '$idSite'")->rowCount();
            $idCli = $dataSite["client_id"];
            $idModele = $dataSite['modele_id'];
            $data_page = $db->query("SELECT * FROM PAGE where site_id='$idSite'")->fetchAll();
            $data_section = $db->query("SELECT * FROM SECTION")->fetchAll();
            $dataClient = $db->query("SELECT * FROM CLIENT WHERE ID = '$idCli'")->fetch();
            $data_modele = $db->query("SELECT * FROM MODELE WHERE ID = '$idModele'")->fetch();
            $nbEltParPage = 1;
            $nbTotalDePage = $nbPageSiteClient/$nbEltParPage;
                if(!isset($_GET['page'])){
                    $_GET['page'] = 0;
                }
                $page = $data_page[$_GET["page"]];
        ?>          
            <div  class="row w-75 mr-12-5 ml-12-5"  style="margin-bottom: 70px;">
                <div class="col w-50">
                    <h1 class="text-center">Page : "<?=$page['nom']?>"</h1>
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
                $cpt=uniqid();
                foreach($data_image as $image){
                    $cpt++;
                    $nomImg = $image['nom'];
                    $alt = $image['alt'];
                    $renseigne = !(empty($image["path"]));
                    $description = $image["description"];
                    $facultatif = "Non";
                    $idImage=$image["id"];
                    $path = $image['path'];
                    if(!empty($image['path'])){
                        $sqlSelectPb = $db->query("SELECT * FROM ERREUR where id_image='$idImage'")->fetch();
                        $pbRegler = true;
                        if(!empty($sqlSelectPb)){if($sqlSelectPb['finish'] == false){$pbRegler = false;}}
                ?>
                <div class="m-4">
                    <p class="text-center "><label class="form-label fw-bold"><?php echo $description;?></label></p>
                    <img src="<?=$path?>" class="img-thumbnail" alt="<?=$alt?>">
                    <span>Texte alternatif :</span>
                    <div class="badge bg-primary text-wrap">
                    <span class="cursorP copySpan" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Copier" data_copy="<?=$image["alt"]?>"><?=$image["alt"]?></span>
                    </div>
                    <a href="<?=$path?>" download="<?=$image["nom"]?>" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Télécharger l'image" class="mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                    </a>
                    <?php
                    if($pbRegler == true){
                    ?>
                    <button class="open-button openFormPb m-3 bgSeed rounded" idForm="<?=$cpt?>">Signaler un problème</button>

                    <!-- The form -->
                    <div class="form-popup" id="<?=$cpt?>">
                        <form method="POST" class="form-container text-center mr-25 ml-25">
                            <label for="psw"><b>Description du problème</b></label>
                            <input type="text" placeholder="Décrire le problème" name="pb" required>

                            <button type="submit" class="btn" name="send_pb" value="<?=$image["id"]?>">Envoyer</button>
                            <button type="button" class="btn cancel closeForm" idForm="<?=$cpt?>">Fermer</button>
                        </form>
                    </div>
                    <?php
                    }else{
                    ?>

                    <button class="open-button openFormPb m-3 bgSeed text-body-emphasis rounded" disabled idForm="<?=$cpt?>">Le problème à été signalé au client.</button>

                    <?php
                    }
                    ?>
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
                    $array_space = array(" ");
                    $nomTxt2 = $texte["nom"];
                    $nomTxt = str_replace($array_space, "-", $texte['nom']);
                    $renseigne_txt = !(empty($texte["contenu"]));
                    $facultatif_txt = "Non";
                    if($texte['facultatif'] == true){$facultatif_txt = "Oui";}
                    if(!empty($data_option)){
?>
                    <div class="m-4 border rounded">
                        <p class="text-start "><label class="form-label fw-bold"><?php echo $nomTxt2;?></label></p>
                        <div class="badge bg-primary text-wrap">
                            <span class="" data_copy="">Texte dans l'option</span>
                        </div>
                    </div>

                        <?php
                    } else{
                        if(!empty($texte["contenu"])){
                    
                ?>
                    <div class="m-2 border rounded">
                        <p class="text-start "><label class="form-label fw-bold"><?php echo $nomTxt2;?></label></p>
                        <div class="badge bg-primary text-wrap">
                            <span class="cursorP copySpan" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Copier" data_copy="<?=$texte["contenu"]?>"><?=$texte["contenu"]?></span>
                        </div>
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
                    
                    <li class="page-item"><a class="page-link" href="index.php?site_id=<?=$idSite?>&page=<?=$i-1?>"><?=$data_page[$i-1]["nom"]?></a></li>

                    <?php
                        }
                    ?>

                        </ul>
                    </nav>
            </div>
            
            
            <script>function redi(){
                window.location = "index.php?site_id=<?=$idSite?>";
            }
            </script>


<?php
        
        if(isset($_POST["send_pb"])){
            if(isset($_POST["pb"])){
                $idImage = (int)$_POST["send_pb"];
                $desc = $_POST["pb"];
                $verifPbExist = $db->query("SELECT * FROM erreur where id_image = '$idImage'")->rowCount();
                if($verifPbExist>0){
                    $sql = $db->query("SELECT * FROM IMAGE WHERE ID='$idImage'")->fetch();
                    $idPage = (int)$sql["page_id"];
                    $sqlUpdatePageFinie = $db->prepare("DELETE from PAGEVALIDE WHERE page = '$idPage'")->execute();
                    $addPb = $db->prepare("UPDATE erreur set description='$desc', finish=0 where id_image='$idImage'")->execute();
                    $reqModifImg = $db->prepare("UPDATE image set facultatif = 0 where id = '$idImage'")->execute();
                }else{
                    $sql = $db->query("SELECT * FROM IMAGE WHERE ID='$idImage'")->fetch();
                    $idPage = (int)$sql["page_id"];
                    $sqlUpdatePageFinie = $db->prepare("DELETE from PAGEVALIDE WHERE page = '$idPage'")->execute();
                    $addPb = $db->prepare("INSERT INTO erreur(id_image, description, finish) value ('$idImage', '$desc', 0)")->execute();
                    $reqModifImg = $db->prepare("UPDATE image set facultatif = 0 where id = '$idImage'")->execute();
                }
                echo "<script>redi()</script>";
            }
        }
        
        
        
    }else{
            echo "Pas d'accès à cette page sans spécifier un site dans la variable \$_GET.";
        }
    }
}
include("../includes/layout_bottom.php");
?>
