<?php session_start();

require('./Class/Autoload.php');

if(!$_SESSION['user']){
    header('Location: login.php');
};

$recetas = Recipes::getAllRecipes();
?>