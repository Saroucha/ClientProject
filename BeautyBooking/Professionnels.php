<?php
require_once 'Connexion.php';
if(!is_logged_in()){
    login_error_redirect();
}

//on place le head et la nav
include 'includes/head.php';
include 'includes/navigation.php';
{

}

?>
<h2>Liste des Professionnels</h2>

<table class="table table-bordered table-striped table-condensed">
<thead><th></th><th>Nom</th><th>Prénom</th><th>Mail</th><th>Ville</th><th>Spécialité</th><th>Nom Entreprise</th><th>Description</th><th>Photo</th><th>FichierA</th><th>FichierB</th><th>Téléphone</th><th>Traité</th><th>Actif</th></thead>

<tbody>
<?php 
$proQuery= $con->query("SELECT id,Nom,Prenom,Mail,Ville,Specialite,Nom_entreprise,Description_entreprise,Photo,FichierA,FichierB,Telephone,Actif,Traite FROM professionnel");

while($pro=mysqli_fetch_assoc($proQuery)):
?>
<tr>
<td></td>
<td><?=$pro['Nom']; ?></td>
<td><?=$pro['Prenom']; ?></td>
<td><?=$pro['Mail']; ?></td>
<td><?=$pro['Ville']; ?></td>
<td><?=$pro['Specialite']; ?></td>
<td><?=$pro['Nom_entreprise']; ?></td>
<td><?=$pro['Description_entreprise']; ?></td>
<td class="text-center"><a href="downloads.php?id=<?php echo $pro['id_Pro'];?>" class="btn btn-primary">php</a>    </td>
<td><?=$pro['FichierA']; ?></td>
<td><?=$pro['FichierB']; ?></td>
<td><?=$pro['Telephone']; ?></td>

<td>
<a class="btn btn-default"  href="actif.php?traite_p=<?php echo $pro['id'];?>"><?php if($pro['Traite']==0){
    echo"Non";
}else{
    echo"Oui";
    
}

?></a></td>
<td>
<a class="btn btn-default"  href="actif.php?actif_p=<?php echo $pro['id'];?>"><?php if($pro['Actif']==0){
    echo"Non";
}else{
    echo"Oui";
    
}

?></a></td>

<td>
</tr>
<?php endwhile;?>
</tbody>
</table>