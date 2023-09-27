<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog -Admin</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>

<body>

    <div class="container">

        <div class="left">

            <?php foreach ($articles as $article) : ?>
                <div class="left-left">

                    <div class="article">
                        <?php
                        $position = strpos($article['corps'], ' ', 180);
                        echo '<h4>' . substr($article['corps'], 0, $position) . ' ... </h4>';
                        ?>
                    </div>

                    <div class="active">
                        <a href="/editer?id=<?= $article['id'] ?>" class="editer">editer</a>
                        <a href="/delete?id=<?= $article['id'] ?>" class="supprimer" onclick="return confirm('Voulez vous suprimer cet article')">supprimer</a>
                    </div>

                </div>

            <?php endforeach ?>

        </div>

    </div>

    <div class="link">
        <?php if ($nb_page > 1) : ?>

            <?php for ($i = 1; $i <= $nb_page; $i++) : ?>
                <?php if ($page == $i) {
                    echo "<span class=\"active\"> $i </span>";
                } else {
                    echo " <a href=\"/admin/admin/p?page=$i\">$i</a> ";
                }
                ?>

            <?php endfor ?>

        <?php endif ?>
    </div>
</body>

</html>