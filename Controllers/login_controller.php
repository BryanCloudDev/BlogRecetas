<?php session_start();

require('./Class/Autoload.php');

$errors = [];

if(isset($_POST['submit'])){
    $userInput = strtolower(clean_data($_POST['username']));
    $password = $_POST['password'];

    if(!empty($userInput) && !empty($password)){
        $userData = User::verifyUserInput($userInput);

        if($userData[0]){

            if(password_verify($password,$userData[1])){
                $user = User::getUserbyInput($userInput);
                $_SESSION['user'] =  $user['id'];
                header('Location: index.php');
            }
            else{
                $errors['errors'] = 'Nombre de usuario/correo o contraseña incorrectos';
            }
        }
        else{
            $errors['errors'] = 'Nombre de usuario/correo o contraseña incorrectos';
        }
    }
    else{
        $errors['errors'] = 'Todos los campos son requeridos';
    }
}