<?php
require_once 'Connexion.php';
unset($_SESSION['$SBUser']);
session_destroy();
header('Location:login.php');

?>