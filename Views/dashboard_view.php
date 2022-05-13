<?php require_once('Views/Components/header.php');?>

<main class="main dashboard">
    <div class="container">
        <section class="users">
            <h2>Usuarios</h2>
            <?php foreach($users as $user):?>
                <div class="row">
                <h2><?= $user['username']?></h2>
                <div class="links">
                    <?php if($_SESSION['user'] == $user['id']):?>
                        <a class="disabled" href="#">Eliminar</a>
                    <?php else:?>
                        <a href="dashboard.php?userid=<?= $user['id']?>">Eliminar</a>
                    <?php endif;?>
                </div>
                
            </div>
            <?php endforeach;?>
        </section>
        <section class="recipes">
            <h2>Recetas</h2>
            <?php if(empty($recipes)):?>
                <div class="row">
                    <h2 class="empty">No hay recetas de momento</h2>
                </div>
            <?php else:?>
                <?php foreach($recipes as $recipe):?>
                    <div class="row">
                        <h2><?= $recipe['title']?></h2>
                        <div class="links">
                            <a href="dashboard.php?recipeid=<?= $recipe['id']?>">Eliminar</a>
                            <a href="update_recipe.php?recipeid=<?= $recipe['id']?>">Actualizar</a>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </section>
    </div>
</main>

<?php require_once ('Views/Components/footer.php');?>