<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog- Editer</title>
    <link rel="stylesheet" href="/css/editer.css">
</head>

<body>
    <h1>
        <marquee direction="">edition d'un article</marquee>
    </h1>

    <form method="post">

        <label> Titre : <input type="text" name="title" placeholder="titre de l'article" value="<?= $article['titre'] ?>"> </label>
        <span> Contenu : </span> <textarea class="article" type="text" name="body" placeholder="contenu de l'article"><?= $article['corps'] ?></textarea>
        <input type="submit" value="Editer">

    </form>
</body>

</html>