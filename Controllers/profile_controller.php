<?php session_start();

require('./Class/Autoload.php');

if(!$_SESSION['user']){
    header('Location: login.php');
};

$id = $_SESSION['user'];

$recipes = Recipes::getRecipeByUserId($id);
$username = User::getUsername($id);
$name = User::getUserFirstName($id);
$email = User::GetUserEmail($id);

?>