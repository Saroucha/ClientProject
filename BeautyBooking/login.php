<?php 
include 'Connexion.php';
include 'includes/head.php';
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);


?>

<style>
body{
    background-image:url("images/background.jpg");
    background-size:100vw 100vh;
    background-attachment:fixed;
}
#login-form{
    width:50%; height:60%; border:2px solid #254258; margin:8% auto; border-radius:15px; padding:15px; box-shadow: 7px 7px 0px rgba(0,0,0,16); background:#fff;
    background-size: auto 250px; 
}
</style>

<div id="login-form">
<div>

<?php
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);


    $user ="select * from admins where email='$email' AND password ='$password'";
    $query=$con->query($user);
    $check_user = mysqli_fetch_assoc($query);

    if($check_user ==0){
        echo"<script>alert('Mot de passe Ou email INCORRECT')</script>";
    }else{
        $user_id = $check_user['id'];
        login($user_id);
        header('Location:accueil.php');
    }

}

?>

</div>
<h2 class="text-center">Login</h2>
<form action="login.php" method="post">
<div class="form-group col-md-8">
<label for="email">Email</label>
<input type="email" name="email" class="form-control col-md-3" id="email" value="<?=$email;?>">
</div>

<div class="form-group col-md-8">
<label for="password">Password</label>
<input type="password" name="password" id="password" class="form-control col-md-3" value="<?=$password;?>">

</div>
<div class="clearfix"></div>
<hr>
<div class="form-group">

<input type="submit" name="login" class="btn btn-default" value="Login">

</div>


</form>


