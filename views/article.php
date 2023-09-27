<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog -Article</title>
    <link rel="stylesheet" href="/css/article.css">
</head>

<body>

    <?php
    echo '<h1>';
    if (isset($error_id)) {
        die($error_id);
    }
    echo '</h1>';

    echo '<h1>';
    if (isset($not_id)) {
        die($not_id);
    }
    echo '</h1>';
    ?>
    <div class="container">

        <h3> <?= $article['titre'] ?> </h3>
        <h4> <?= $article['corps'] ?> </h4>

    </div>

    <div class="space-comments">
        <h1>Espace commentaires</h1>

        <div class="comments">
            <?php if (isset($no_comments)) {
                echo $no_comments;
            } else {
                foreach ($comments as $comment) {
                    echo '<div class="comment">';
                    echo '<h5>' . $comment['created_at'] . '</h5>';
                    echo  $comment['utilisateur'] . ' : ' . $comment['comment'];
                    echo '</div>';
                }
            }
            ?>
        </div>

    </div>

    <?php if (isset($_SESSION['utilisateur'])) : ?>

        <form method="post" class="write-comment">

            <textarea name="commentaire"></textarea>

            <input type="submit" value="Commenter">

        </form>

    <?php endif ?>

</body>

</html>