<?php
require_once 'Connexion.php';
if(!is_logged_in()){
    header('Location:login.php');
}
include 'includes/head.php';
include 'includes/navigation.php';

$proQuery= $con->query("SELECT COUNT(Traite) FROM professionnel WHERE Traite='0'");
$pro=array_count_values($proQuery);




?>


<h1 class="text-center" style="margin-top:25%;">Bienvenue <b><?=$user_data['first']; ?></b>!</h1>
<h4><?php echo $pro;?></h4>