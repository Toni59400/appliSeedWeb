<?php
include("../config/config.php");
include("../config/dbconnection.php");
include("../includes/layout.php");
?>
        <link rel="stylesheet" href="../css/style.css">
        <title>SeedWeb | Clients</title>
    </head>
    <body class="text-center w-100 m-auto">
<?php
include("../includes/header.php");
if(isset($_SESSION["role"])){
    if($_SESSION["role"] == "admin"){
?>

<h1>Dans Clients (admin uniquement)</h1>

<?php
}else{
?>
<h1>Pas d'autorisation pour accéder à cette page.</h1>
<?php
}}
    include("../includes/layout_bottom.php");
?>