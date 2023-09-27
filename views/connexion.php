<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/css/connexion.css">
</head>

<body>

    <div class="container">

        <div class="instruction">
            <h3>Veuillez remplir tous les champs</h3>
        </div>

        <form method="post">
            <div>
                <p> <input class="pseudo" type="text" name="pseudo" placeholder="Votre pseudo" autocomplete="off" required></p>
                <?php if (isset($errors))
                    echo '<h5>' . $errors[0] . '</h5>' ?>
            </div>

            <div>
                <p> <input type="password" name="mdp" placeholder="Votre mot de passe" autocomplete="off" required></p>
                <?php if (isset($errors))
                    echo '<h5>' . $errors[1] . '</h5>'  ?>
            </div>


            <div>
                <p> <input type="submit" value="Se connecter"></p>
            </div>

        </form>

        <div class="forget">
            <h4> <a href="">Mot de passe oublie ?</a> </h4>
        </div>

    </div>

</body>

</html>