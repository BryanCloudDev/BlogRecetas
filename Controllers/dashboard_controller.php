<?php session_start();

require('./Class/Autoload.php');

if(!(User::getUserRol($_SESSION['user']))){
    header('Location: index.php');
}

$users = User::getUsers();
$recipes = Recipes::getAllRecipes();

if(isset($_GET['recipeid'])){
    User::deleteRegister($_GET['recipeid'],RECIPES);
    header('Location: ' . $_SERVER['PHP_SELF']);
}

if(isset($_GET['userid'])){
    User::deleteRegister($_GET['userid'],USERS);
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>