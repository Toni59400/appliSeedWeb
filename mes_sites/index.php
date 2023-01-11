<?php
session_start();
include("../config/config.php");
include("../config/dbconnection.php");
include("../includes/layout.php");
?>

        <title>SeedWeb | Mes Sites</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if($_SESSION["role"] == "client"){
?>

<h1>Dans Mes Sites (clients uniquement)</h1>

<?php
}else{
?>
<h1>Pas d'autorisation pour accéder à cette page.</h1>
<?php
}
    include("../includes/layout_bottom.php");
?>