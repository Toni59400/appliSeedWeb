<?php
if(isset($_SESSION['role'])){
    if($_SESSION["role"] == "admin"){
    ?>  
            <div class="container">
                <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                        <div>
                            <a href="../accueil/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                                <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                            </a>
                        </div>  
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="../accueil/" class="active nav-link bgSeed rounded-pill" aria-current="page">Accueil</a></li>
                        <li class="nav-item "><a href="../clients/" class="nav-link color_seedWeb">Clients</a></li>
                        <li class="nav-item "><a href="../modeles/" class="nav-link color_seedWeb">Modèles</a></li>
                        <li class="nav-item "><a href="../sites/" class="nav-link color_seedWeb">Sites</a></li>
                        <li class="nav-item "><a href="../sections/" class="nav-link color_seedWeb">Sections</a></li>
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
                        <a href="./index.php?unco=1">
                            <li class="m-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#10aaae" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
    <?php
    }else if($_SESSION["role"] == "client"){
    ?>
            <div class="container">
                <div class="d-flex justify-content-around align-items-center pt-3 mb-4 border-bottom">
                    <div>
                        <a href="../accueil/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                            <img class="mb-4" style="max-width: 150px;"src="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp" alt="logo_seed_web" >
                        </a>
                    </div>  
                    <ul class="nav nav-pills align-items-center">
                        <li class="nav-item"><a href="../accueil/" class="nav-link active bgSeed rounded-pill" aria-current="page">Accueil</a></li>
                        <li class="nav-item color_seedWeb"><a href="../mes_formulaires/" class="nav-link color_seedWeb">Mon formulaire</a></li>
                        <li class="nav-item color_seedWeb"><a href="https://seedweb.fr/" class="nav-link color_seedWeb">SeedWeb</a></li>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#10aaae" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
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
                <li class="nav-item color_seedWeb"><a href="https://seedweb.fr/" class="nav-link color_seedWeb">SeedWeb</a></li>
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