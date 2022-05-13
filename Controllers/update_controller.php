<?php session_start();

require_once('./Class/Autoload.php');

if(isset($_GET['recipeid'])){
    if(!isset($_SESSION['recipeid'])){
        $_SESSION['recipeid'] = $_GET['recipeid'];
    }
    elseif(!empty($_SESSION['recipeid'])){
        $_SESSION['recipeid'] = $_GET['recipeid'];
    }
}

$id = $_SESSION['recipeid'];

$recipe = Recipes::getRecipe($id);
$recipeSteps = explode('.',$recipe['steps']);


if(!isset($_SESSION['updateSteps'])){
    $_SESSION['updateSteps'] = [];
}

if(empty($_SESSION['updateSteps'])){
    foreach($recipeSteps as $step){
        $_SESSION['updateSteps'][] = $step;
    }
}

if(!empty($_POST['postSteps']) && !isset($_POST['stepEditId'])){
    $_SESSION['updateSteps'][] = $_POST['postSteps'];
}
if(isset($_POST['deleteStep'])){
    unset($_SESSION['updateSteps']["{$_POST['deleteStep']}"]);
    $_SESSION['updateSteps'] = array_values($_SESSION['updateSteps']);
}
if(isset($_POST['stepEditId'])){
    $_SESSION['updateSteps']["{$_POST['stepEditId']}"] = $_POST['postSteps'];
}

if(isset($_POST['publish']) && $_POST['publish'] == 'Actualizar'){

    $title = clean_data($_POST['postTitle']);
    $description = clean_data($_POST['descriptionPost']);
    $postSteps = implode('.',$_SESSION['updateSteps']);

    $imagenLast = Recipes::getImagePath($id);

    if(!empty($_FILES['imagenPost']) && !empty($_FILES['imagenPost']["tmp_name"])){
        unlink($imagenLast);
        $path = uploadImage($_FILES["imagenPost"],'Media/recipe/');
        if(!$path[1]){
            $errors['recipeImage'] = $dest_path[0];
        }
        $path = $path[0];
    }
    else{
        $path = $imagenLast;
    }
    Recipes::updateRegister($id,[$id,$title,$description,$path,$postSteps,$recipe['created_by'],$recipe['date']],RECIPES,KEYS_RECIPE);
    $_SESSION['updateSteps'] = [];
    header('Location: index.php');
}
