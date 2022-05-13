<?php session_start();
require('./Class/Autoload.php');

if(!$_SESSION['user']){
    header('Location: login.php');
};

$errors = [];

if(empty($_SESSION['createRecipeSteps'])){
    $_SESSION['createRecipeSteps'] = [];
}

if(!empty($_POST['postSteps']) && !isset($_POST['stepEditId'])){
    $_SESSION['createRecipeSteps'][] = $_POST['postSteps'];
}

if(isset($_POST['deleteStep'])){
    unset($_SESSION['createRecipeSteps'][$_POST['deleteStep']]);
    $_SESSION['createRecipeSteps'] = array_values($_SESSION['createRecipeSteps']);
}

if(isset($_POST['stepEditId'])){
    $_SESSION['createRecipeSteps']["{$_POST['stepEditId']}"] = $_POST['postSteps'];
}

if(isset($_POST['publish']) && $_POST['publish'] == 'Publicar'){

    $RecTitle = clean_data($_POST['tituloPost']);
    $recDescription = clean_data($_POST['descripcionPost']);
    $recSteps = implode('.',$_SESSION['createRecipeSteps']);

    $dest_path = uploadImage($_FILES["imagenPost"],'Media/recipe/');

    if(!$dest_path[1]){
        $errors['recipeImage'] = $dest_path[0];
    }

    if($errors == []){
        $newID = GetId::idCount(RECIPES) + 1;
        $spanishDate = SpanishDate();
        $id_usuario = $_SESSION["user"];
        $recipe = new Recipes;
        $recipe->makeRegister(KEYS_RECIPE,[$newID,$RecTitle, $recDescription,$dest_path[0],$recSteps,$id_usuario,$spanishDate],RECIPES);
        GetId::updateIdCount(RECIPES);
        $_SESSION['createRecipeSteps'] = [];
        header("Location: index.php");
    }
}
?>
