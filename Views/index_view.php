<?php require_once('Views/Components/header.php');?>

<main class="main index">
    <div class="container">
    <a class="newPost" href="./create_recipe.php"> <i class="button-crearReceta" aria-hidden="true">Crear Receta</i></a>
        <?php foreach($recetas as $receta): ?>
            <article class="post">
                <div class="imgContainer">
                    <img src="<?= $receta["image"] ?>" alt="<?= $receta["title"] ?>">
                </div>
                <div class="texto">
                    <h2><a href="recipe.php?id=<?= $receta["id"];?>"><?= $receta["title"] ?></a></h2>
                    <p class="date">Creado el <?= $receta["date"];?></p>
                    <p><?= $receta["description"];?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once ('Views/Components/footer.php');?>