<?php require_once('Views/Components/header.php');?>

<main class="main index">
    <div class="container">
        <article id="idArticulo" class="post">
            <div class="imgContainer">
                <img src="<?= $recipe['image'] ?>" alt="Comida o algo">
            </div>
            <div class="texto">
                <h2><?= $recipe['title'] ?></h2>
                <p class="date">Creado el <?= $recipe['date'];?></p>
                <p><?= $recipe['description'] ?></p>
                <p>
                    <ol>
                    <?php
                        foreach($steps as $step){
                            echo "<li>$step</li>";
                        };
                    ?>
                    </ol>
                </p>
            </div>
        </article>
    </div>
</main>

<?php require_once ('Views/Components/footer.php');?>