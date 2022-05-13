<?php session_start();

require('./Class/Autoload.php');

if(isset($_GET['id'])){
    $recipe = Recipes::getRecipe($_GET['id']);
}else{
    header('Location: index.php');
}

$steps = explode('.',$recipe['steps']);

?>