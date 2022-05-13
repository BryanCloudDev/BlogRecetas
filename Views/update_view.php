<?php require_once('Views/Components/header.php');?>

<main class="main crearReceta">
    <div class="container">
        <form name="form" action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
            <div class="rowi">
                <h1>Actualizar receta</h1>
            </div>
            <div class="rowi">
                <label for="postTitle">Titulo de la receta</label>
                <input type="text" name="postTitle" id="postTitle" required value="<?php $message = $recipe['title'] ?? ''; echo htmlspecialchars($message);?>">    
            </div>
            <div class="rowi">
                <label for="descriptionPost">Descripcion de la receta</label>
                <input type="text" name="descriptionPost" id="descriptionPost" required value="<?php $message = $recipe['description'] ?? ''; echo htmlspecialchars($message);?>">
            </div>
            <div class="rowi">
            <label for="postSteps">Pasos a seguir</label>
                <input class="itemsInput" type="text" name="postSteps" id="postSteps" value="<?php if(isset($_POST['editStep'])){echo htmlspecialchars($_SESSION['updateSteps']["{$_POST['editStep']}"]);};?>">
                <?php if(isset($_POST['editStep'])):?>
                    <input type="hidden" name="stepEditId" value="<?= htmlspecialchars($_POST['editStep']);?>">
                <?php endif;?>
                <input class="items Submit" type="submit" value="Agregar" name="agregar">
            </div>
            <div class="items">
                <ol>
                <?php foreach($_SESSION['updateSteps'] as $id => $step):?>
                    <div class='pasoRow'>
                        <li><?= $step;?></li>
                        <div class="editButtons">
                            <button type='submit' name='deleteStep' value='<?= $id;?>'>Borrar</button>
                            <button type='submit' name='editStep' value='<?= $id;?>'>Editar</button>
                        </div>
                    </div>
                <?php endforeach;?>
                </ol>
            </div>
            <div class="rowi">
                <label for="postSteps">Foto del platillo</label>
                <img src="<?= $recipe['image'] ?>" alt="Imagen Ingresada" class="tiny_image">
                <input type="file" name="imagenPost">
            </div>
            <input type="hidden" name="actualizarId" value="<?= $_SESSION['recipeId']; ?>">
            <input type="submit" name="publish" value="Actualizar">
        </form>
    </div>
</main>

<?php require_once ('Views/Components/footer.php');?>