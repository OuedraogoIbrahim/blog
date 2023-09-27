<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog - contact</title>
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>

    <h1> Vous desirez nous contacter </h1>

    <?php if (isset($succes)) {
        echo '<h2>' . $succes . '</h2>';
    }
    ?>
    <form method="post">

        <p> <input type="text" name="nom" placeholder="Votre nom" autocomplete="off"> </p>
        <?php if (isset($error_nom)) echo '<h5>' . $error_nom . '</h5>' ?>

        <p> <input type="text" name="motif" placeholder="Motif" autocomplete="off"> </p>
        <?php if (isset($error_motif)) echo '<h5>' . $error_motif . '</h5>' ?>

        <p> <textarea class="message" name="message" placeholder="Votre message" autocomplete="off"></textarea> </p>
        <?php if (isset($error_message)) echo '<h5>' . $error_message . '</h5>' ?>

        <p> <input class="button" type="submit" value="Envoyer"> </p>

    </form>

</body>

</html>