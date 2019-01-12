<?php


function login_error_redirect($url ='login.php'){
    $_SESSION['error_flash']='Veuillez vous connecter !';
    header('Location:'.$url);
}

function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function login($user_id){
$_SESSION['SBUser']=$user_id;
global $con;
header('Location:accueil.php');
}


function is_logged_in(){
    if(isset($_SESSION['SBUser']) && $_SESSION['SBUser']>0){
        return true;
    }
    return false;
}

 	function storeUser($mail, $motdepasse){ 
 		global $con; 
 		 
 		$query = "INSERT INTO professionnel("; 
 		$query .= "mail, MotDePasse) "; 
 		$query .= "VALUES('{$mail}','{$motdepasse}')"; 
  
 		$result = mysqli_query($con, $query); 
  
 		if($result){ 
 			$pro = "SELECT * FROM professionnel WHERE mail = '{$mail}'"; 
 			$res = mysqli_query($con, $pro); 
  
 			while ($pro = mysqli_fetch_assoc($res)){ 
 				return $pro; 
 			} 
 		}else{ 
 				return false; 
 			}   
 	} 
  
  
 	function getUserByEmailAndPassword($mail, $motdepasse){ 
 		global $con; 
 		$query = "SELECT * from professionnel where Mail = '{$mail}' and MotDePasse = '{$motdepasse}'"; 
 	 
 		$pro = mysqli_query($con, $query); 
 		 
 		if($pro){ 
 			while ($res = mysqli_fetch_assoc($pro)){ 
 				return $res; 
 			} 
 		} 
 		else{ 
 			return false; 
 		} 
 	} 
  
 	function emailExists($mail){ 
 		global $con; 
 		$query = "SELECT Mail from professionnel where Mail = '{$mail}'"; 
 		$result = mysqli_query($con, $query); 
  
 		if(mysqli_num_rows($result) > 0){ 
 			return true; 
 		}else{ 
 			return false; 
 		} 
 	} 



?>