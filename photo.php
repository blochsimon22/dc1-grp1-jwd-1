<?php
require_once 'functions.php';
require_once 'model/database.php';

$id = $_GET["id"];

$photo = getPhoto($id);
$liste_commentaires = getAllCommentairesByPhoto($id);
$liste_tags = getAllTagsByPhoto($id);

getHeader($photo["titre"], "Description de la photo");
?>

<header>
    <div class="row col_center">
        <?php getMenu(); ?>
    </div>
</header>

<main class="container">

    <h1><?php echo $photo["titre"]; ?></h1>
    <img src="images/<?php echo $photo["image"] ?>">
    
    <?php foreach ($liste_tags as $tag) : ?>
        <a href="tag.php?id=<?php echo $tag["id"]; ?>">
            # <?php echo $tag["titre"] ?>
        </a>
    <?php endforeach; ?>
    
    <p><?php echo $photo["description"] ?></p>
    
    <form method="POST" action="insert-commentaire.php">
        <textarea name="commentaire"></textarea>
        <input type="hidden" name="photo_id" value="<?php echo $id; ?>">
        <input type="submit">
    </form>

    <section class="commentaires">
        <?php foreach ($liste_commentaires as $commentaire) : ?>
            <article>
                <time datetime="<?php echo $commentaire["date_creation"]; ?>">
                    <?php echo $commentaire["date_creation"]; ?>
                </time>
                <p><?php echo $commentaire["contenu"]; ?></p>
            </article>
        <?php endforeach; ?>
    </section>

</main>

<?php getFooter(); ?>
