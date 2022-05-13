<?php session_start();

require_once('./Class/Autoload.php');

$errors = [];

if(isset($_POST['submit'])){
    $name = clean_data($_POST['nombre']);
    $lastName = clean_data($_POST['apellido']);
    $username = clean_data($_POST['username']);
    $email = clean_data($_POST['correo']);
    $password = clean_data($_POST['password']);

    $checkText = checkText($name,[4,20],'/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/',['Porfavor ingresa un nombre valido','El nombre debe de ser entre 4 y 20 caracteres']);
    if(!$checkText[0])
    {
            $errors['name'] = $checkText[1];
    }

    $checkText = checkText($lastName,[4,20],'/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/',['Porfavor ingresa un apellido valido','El apellido debe de ser entre 4 y 20 caracteres']);
    if(!$checkText[0])
    {
        $errors['lastName'] = $checkText[1];
    }

    if(strlen($email) >= 10 && strlen($email) <= 50)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = 'Pordavor ingresa un correo valido';
        }
        if(User::existsEmail($email)){
            $errors['email'] = 'El correo ya esta en uso. <a href="login.php">Iniciar sesion?<a>';
        }
    }
    else
    {
        $errors['email'] = 'Porfavor ingresa un correo valido';
    }

    $checkText = checkText($password,[8,30],'/^[a-zA-Z0-9-_%*?!@#$]+$/',['Caracteres especiales permitidos: -_%*?!@#$','Usa una contraseña entre 8 y 30 caracteres']);
    if(!$checkText[0])
    {
        $errors['password'] = $checkText[1];
    }

    $checkText = checkText($username,[4,10],'/^[a-zA-Z0-9_]+$/',['Nombre de usuario solo puede contener numeros y guion bajo "_"','El nombre de usuario debe de ser entre 4 y 10 caracteres']);
    if(!$checkText[0])
    {
        $errors['username'] = $checkText[1];
    }

    if($checkText[0] && User::existsUser($username)){
        $errors['username'] = 'El nombre de usuario ya ha sido tomado, selecciona otro';
    }

    if(isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK)
    {
        $dest_path = uploadImage($_FILES['user_image'],'Media/profilePhoto/','Media/');

        if(!$dest_path[1])
        {
            $errors['user_image'] = $dest_path[0];
        }
        else
        {
            $dest_path = $dest_path[0];
        }
    }
    else
    {
        $dest_path = 'https://i.imgur.com/GvUsGWz.jpg';
    }

    if($errors == [])
    {
        $newID = GetId::idCount(USERS) + 1;
        $token = md5($email.$password.'5e83b87c6ff6b1cc4d941bf315281da1');
        $password = User::encPass($password);
        $username = strtolower($username);
        $email = strtolower($email);
        $user = new User;
        $user->makeRegister(KEYS_USER,[$newID,$token,FALSE,$name,$lastName,$username,$password,$email,$dest_path],USERS);
        GetId::updateIdCount(USERS);
        header('Location: login.php');
    }
}