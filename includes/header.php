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
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="../accueil/" class="nav-link active bgSeed rounded-pill" aria-current="page">Accueil</a></li>
                        <li class="nav-item color_seedWeb"><a href="../mes_formulaires/" class="nav-link color_seedWeb">Mon formulaire</a></li>
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
?>