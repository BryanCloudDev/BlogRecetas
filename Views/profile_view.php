<?php require_once('Views/Components/header.php');?>

<main class="main perfil">
    <div class="container">
        <section class="card">
            <div class="header">
                <div class="profileContainer">
                    <img src="<?= $userImage; ?>" alt="foto de perfil">
                </div>
            </div>
            <div class="body">
                <table>
                <tr>
                    <td>Nombre</td>
                    <td><?= $name;?></td>
                </tr>
                <tr>
                    <td>Nombre de usuario</td>
                    <td><?= $username;?></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><?= $email;?></td>
                </tr>
                </table>
            </div>
        </section>
        <section class="info">
            <h1>Posts creados por <?= $name?>:</h1>
            <h2><?= count($recipes);?> <?= count($recipes) > 1 ? "posts" : "post";?></h2>
        </section>
        <?php foreach($recipes as $recipe): ?>
        <article class="post">
            <div class="imgContainer">
                <img src="<?= $recipe['image'];?>" alt="Comida o algo">
            </div>
            <div class="texto">
                <h2><a href="recipe.php?id=<?= $recipe['id']; ?>"><?= $recipe["title"]; ?></a></h2>
                <p class="date">Creado el <?= $recipe['date'];?></p>
                <p><?= $recipe["description"] ?></p>
            </div>
        </article>
        <?php endforeach; ?>
        <a class="newPost" href="create_recipe.php"> 
            <i class="button-crearReceta" aria-hidden="true">Crear Receta</i>
        </a>
    </div>
</main>

<?php require_once ('Views/Components/footer.php');?>