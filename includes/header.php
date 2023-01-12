<?php
if(isset($_SESSION['role'])){
    if($_SESSION["role"] == "admin"){
    ?>  
            <div class="container">
                <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp"></use></svg>
                    <span class="fs-4">SeedWeb - Application</span>
                </a>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="./accueil/" class="nav-link active" aria-current="page">Accueil</a></li>
                    <li class="nav-item color_seedWeb"><a href="../clients/" class="nav-link">Clients</a></li>
                    <li class="nav-item color_seedWeb"><a href="../modeles/" class="nav-link">Modèles</a></li>
                    <li class="nav-item color_seedWeb"><a href="../sites/" class="nav-link">Sites</a></li>
                    <li class="nav-item color_seedWeb"><a href="../sections/" class="nav-link">Sections</a></li>
                </ul>
                </header>
            </div>
    <?php
    }else if($_SESSION["role"] == "client"){
    ?>
            <div class="container">
                <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp"></use></svg>
                    <span class="fs-4">SeedWeb - Application</span>
                </a>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="../accueil/" class="nav-link active" aria-current="page">Accueil</a></li>
                    <li class="nav-item color_seedWeb"><a href="../mes_sites/" class="nav-link">Mes sites</a></li>
                    <li class="nav-item color_seedWeb"><a href="../mes_formulaires/" class="nav-link">Mes formulaires</a></li>
                    <li class="nav-item color_seedWeb"><a href="#" class="nav-link">SeedWeb</a></li>
                </ul>
                </header>
            </div>
    <?php
}}else{
?>

        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="https://seedweb.fr/wp-content/uploads/2022/12/Logo-seedweb-rectangle.png.webp"></use></svg>
                <span class="fs-4">SeedWeb - Application</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="../" class="nav-link active" aria-current="page">Connexion</a></li>
                <li class="nav-item color_seedWeb"><a href="#" class="nav-link">SeedWeb</a></li>
            </ul>
            </header>
        </div>

<?php
}
?>