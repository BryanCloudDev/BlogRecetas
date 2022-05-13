<?php require_once('Views/Components/header.php');?>

<main class="main register">
    <div class="container">
        <div class="texto">
            <h1>Registrate</h1>
            <p>Por favor rellena los campos para poder registrarte, es gratis.</p>
        </div>
        <form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="formLogin" enctype="multipart/form-data">
            <div class="form-group">
                <label for="usuario">Nombre</label>
                <input id="usuario" type="text" name="nombre" class="form-control" placeholder="John" required value="<?php $message =  $errors == [] ? '' : $name; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="usuario">Apellido</label>
                <input id="usuario" type="text" name="apellido" class="form-control" placeholder="Doe" required value="<?php $message =  $errors == [] ? '' : $lastName; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input id="usuario" type="text" name="username" class="form-control" placeholder="MiUsuario01" required value="<?php $message =  $errors == [] ? '' : $username; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="usuario">Correo</label>
                <input id="usuario" type="email" name="correo" class="form-control" placeholder="micorreo@micorreo.com" required value="<?php $message =  $errors == [] ? '' : $email; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="********" required value="<?php $message =  $errors == [] ? '' : $password; echo htmlspecialchars($message);?>">
            </div>
            <div class="form-group">
                <label for="foto">Foto de perfil</label>
                <div class="custom-input-file">
                    <input type="file" id="foto" class="input-file" name="user_image">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Sign Up">
            </div>
        </form>
        <?php if($errors != []):?>
            <div class="error">
                <ul>
                <?php foreach($errors as $error):?>
                    <li><?= $error;?></li>
                <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>
    </div>
</main>

<?php require_once ('Views/Components/footer.php');?>