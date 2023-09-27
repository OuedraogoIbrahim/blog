<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="stylesheet" href="css/articles.css">
</head>

<body>

    <div class="container">
        <ul>

            <?php foreach ($articles as $article) : ?>
                <li>
                    <div class="articles">
                        <h3><?= $article['titre'] ?> </h3>
                        <?php
                        $position = strpos($article['corps'], ' ', 180);
                        echo '<h4>' . substr($article['corps'], 0, $position) . ' ... </h4>';
                        ?>
                    </div>
                    <a href="/article?id=<?= $article['id'] ?>"> Consulter </a>
                </li>
            <?php endforeach ?>


        </ul>

    </div>

    <div class="link">
        <?php if ($nb_page > 1) : ?>

            <?php for ($i = 1; $i <= $nb_page; $i++) : ?>
                <?php if ($page == $i) {
                    echo "<span class=\"active\"> $i </span>";
                } else {
                    echo " <a href=\"/articles?page=$i\">$i</a> ";
                }
                ?>

            <?php endfor ?>

        <?php endif ?>
    </div>


</body>

</html>