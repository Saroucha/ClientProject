<?php 
include 'Connexion.php';
if(isset($_GET['id_Pro'])){
$id= $_GET['id_Pro'];
$stat =$con->query("SELECT * FROM professionnel WHERE id_Pro=?");
$stat->bindParam(1,$id);
$stat->execute();
$data=$stat->fetch();

$file = "media/".$data['Photo'];
if(file_exists($file)){
    header('Content-Description: FileTransfer');
    header('Content-Type:application/octet-stream;');
    header("Content-Disposition:attachment; filename=".basename($file));
    header('Content-Transfer-Encoding:binary');
    header('Expires:0');
    header('Cache-Control:must-revalidate');
    header('pragma:public', true);
    header('Content-Length:'.filesize($file));
 
    readfile($file);
    exit;
}else{
    echo "error";
}

}


?>