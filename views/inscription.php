<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/inscription.css">
</head>

<body>

    <div class="container">

        <div class="instruction">
            <h3>Veuillez remplir tous les champs</h3>
        </div>

        <form method="post">
            <div>
                <p> <input class="pseudo" type="text" name="pseudo" placeholder="Votre pseudo" autocomplete="off" required></p>
                <?php if (isset($errors[0]))
                    echo '<h5>' . $errors[0] . '</h5>' ?>
            </div>

            <div>
                <p> <input type="password" name="mdp" placeholder="Votre mot de passe" autocomplete="off" required></p>
                <?php if (isset($errors[1]))
                    echo '<h5>' . $errors[1] . '</h5>' ?>
            </div>

            <div>
                <p> <input type="email" name="email" placeholder="Votre email" autocomplete="off" required>
                </p>
                <?php if (isset($errors[2]))
                    echo '<h5>' . $errors[2] . '</h5>'  ?>
            </div>

            <div>
                <p> <input type="submit" value="S'inscrire"></p>
            </div>

        </form>

        <div class="pass">
            <h4> Rejoignez-nous</h4>
        </div>

    </div>

</body>

</html>