<?php
if(isset($_SESSION['role'])){
    if($_SESSION["role"] == "admin"){
        $url = $_SERVER["REQUEST_URI"];
        $idAdm = $_SESSION["id_client"];
        $dataAdm = $db->query("SELECT * FROM client where id = '$idAdm'")->fetch();
    ?>  
            <div class="container">
            <p class="text-end">Bonjour <?=$dataAdm["prenom"]?> <?=$dataAdm["nom"]?> ! <?php if($dataAdm["prenom"] == "Rémy" || $dataAdm["prenom"] == "Valentine" || $dataAdm["prenom"] == "Alexia"){?>
                <img src="../img/rclens.svg" style="heigth:20px; width:20px;"/>
            <?php } ?>
            </p>
                <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                        <div>
                            <a href="../accueil/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                                <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                            </a>
                        </div>  
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="../accueil/" class="<?php if($url=="/accueil/"){echo "nav-link active bgSeed rounded-pill";}else{echo "nav-link color_seedWeb";}?>" aria-current="page">Accueil</a></li>
                        <li class="nav-item "><a href="../clients/" class="<?php if($url=="/clients/"){echo "nav-link active bgSeed rounded-pill";}else{echo "nav-link color_seedWeb";}?>">Clients</a></li>
                        <li class="nav-item "><a href="../sites/" class="<?php if($url=="/sites/"){echo "nav-link active bgSeed rounded-pill";}else{echo "nav-link color_seedWeb";}?>">Sites</a></li>
                        
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Option
                                </button>
                                <ul class="dropdown-menu">
                                    <form method="POST">
                                        <li class="nav-item "><a href="../formulaire/" class="nav-link color_seedWeb">Notification</a></li>
                                        <li class="nav-item "><a href="../modeles/" class="nav-link color_seedWeb">Modèles</a></li>
                                        <li class="nav-item "><a href="../sections/" class="nav-link color_seedWeb">Sections</a></li>
                                        <li><input type="submit" name="dark" class="dropdown-item" value="Thème Dark"/></li>
                                        <li><input type="submit" name="light" class="dropdown-item" value="Thème Light"/></li>
                                    </form>
                                </ul>
                            </div>
                        </li>
                        <a href="./index.php?unco=1">
                            <li class="m-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#10aaae" class="bi bi-power" viewBox="0 0 16 16">
                                <path d="M7.5 1v7h1V1h-1z"/>
                                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                            </svg>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
    <?php
    }else if($_SESSION["role"] == "client"){
        $url = $_SERVER["REQUEST_URI"];
    ?>
            <div class="container">
                <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                    <div>
                        <a href="../accueil/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                            <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                        </a>
                    </div>  
                    <ul class="nav nav-pills align-items-center">
                        <li class="nav-item"><a href="../accueil/" class="<?php if($url=="/accueil/"){echo "nav-link active bgSeed rounded-pill";}else{echo "nav-link color_seedWeb";}?>" aria-current="page">Accueil</a></li>
                        <li class="nav-item color_seedWeb"><a href="../mes_formulaires/" class="<?php if($url=="/mes_formulaires/"){echo "nav-link active bgSeed rounded-pill";}else{echo "nav-link color_seedWeb";}?>">Mon formulaire</a></li>
                        <li class="nav-item color_seedWeb"><a href="https://seedweb.fr/" class="nav-link color_seedWeb" target="_blank">SeedWeb</a></li>
                        <li>
                            <div class="dropdown">
                                <button class="color_seedWebH dropdown-toggle color_seedWeb bg-transparent" style="border: none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Theme
                                </button>
                                <ul class="dropdown-menu">
                                    <form method="POST">
                                        <li><input type="submit" name="dark" class="dropdown-item" value="Dark"/></li>
                                        <li><input type="submit" name="light" class="dropdown-item" value="Light"/></li>
                                    </form>
                                </ul>
                            </div>
                        </li>
                        <a href="./index.php?unco=1">
                            <li class="m-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#10aaae" class="bi bi-power" viewBox="0 0 16 16">
                                <path d="M7.5 1v7h1V1h-1z"/>
                                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                            </svg>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
    <?php
}}else{
?>

        <div class="container">
            <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                <div>
                    <a href="../accueil/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                    </a>
                </div>  
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="../" class="nav-link active bgSeed rounded-pill" aria-current="page">Connexion</a></li>
                <li class="nav-item color_seedWeb"><a href="https://seedweb.fr/" class="nav-link color_seedWeb" target="_blank">SeedWeb</a></li>
                <li>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Theme
                                </button>
                                <ul class="dropdown-menu">
                                    <form method="POST">
                                        <li><input type="submit" name="dark" class="dropdown-item" value="Dark"/></li>
                                        <li><input type="submit" name="light" class="dropdown-item" value="Light"/></li>
                                    </form>
                                </ul>
                            </div>
                        </li>
            </ul>
            </div>
        </div>

<?php
}

if(isset($_GET['unco'])){
    session_destroy();
    header("Location: ../index.php");
}
?>