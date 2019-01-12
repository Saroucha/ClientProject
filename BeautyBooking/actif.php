<?php
// actif pro
include 'Connexion.php';

$proQuery= $con->query("SELECT id,Nom,Prenom,Mail,Ville,Specialite,Nom_entreprise,Description_entreprise,Photo,FichierA,FichierB,Telephone,Actif,Traite FROM professionnel");

$pro=mysqli_fetch_assoc($proQuery);


if(isset($_GET['actif_p'])){
    $actif_id=$_GET['actif_p'];
    $actif =$pro['Actif'];
    $Traite =$pro['Traite'];
    if($actif==0){
        $actif=1;
        $Traite==1;
    }else{
        $actif=0;
        $Traite==1;
    }
    $actif_p="update Professionnel SET Actif ='$actif', Traite='$actif' WHERE id='$actif_id'";
    $run_actif=mysqli_query($con,$actif_p);
    if($run_actif AND $actif==1 ){
        echo"<script>alert('Le compte a été activé')</script>";
        echo"<script>window.open('Professionnels.php','_self')</script>";
    } if($run_actif AND $actif==0){
        $actif=1;
        echo"<script>window.open('Professionnels.php','_self')</script>";
    }
   
}



if(isset($_GET['traite_p'])){
    $traite_id=$_GET['traite_p'];
    $traite_p="update Professionnel SET Traite='1' WHERE id_Pro='$traite_id'";
    $run_traite=mysqli_query($con,$traite_p);
    if($run_traite){
        echo"<script>alert('Le compte a été traité')</script>";
        echo"<script>window.open('Professionnels.php','_self')</script>";
    } 
   
}
?>