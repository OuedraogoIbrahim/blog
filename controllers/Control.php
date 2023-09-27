<?php

declare(strict_types=1);

namespace App\controllers;

session_start();

require_once __DIR__ . '/../models/Data.php';
require_once __DIR__ . '/../functions/enregistrements/commentaires.php';

use App\models\Data;

class Control
{


    // La page d'accueil du site
    public function accueil()
    {
        require_once __DIR__ . '/../views/accueil.html';
    }


    // Formulaire d'incription
    public function inscription()
    {
        $errors = null;
        if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['email'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $email = htmlspecialchars($_POST['email']);

            $_POST['email'] = $email;

            if (strlen($pseudo) <= 3) {
                $errors[0] = 'votre pseudo est trop court';
            } else {
                $_POST['pseudo'] = $pseudo;
            }

            if (strlen($mdp) <= 5) {
                $errors[1] = 'votre mot de passe est trop court';
            } else {
                $mdp = password_hash($mdp, PASSWORD_DEFAULT, ['cost' => 14]);
                $_POST['mdp'] = $mdp;
            }

            if ($errors == null) {
                $insert = new Data();
                $insert->insert();
                $_SESSION['utilisateur'] = $_POST['pseudo'];
                header('location:/');
                die();
            }
        }
        require_once __DIR__ . '/../views/inscription.php';
    }

    // Formulaire de connexion
    public function connexion()
    {
        if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
            $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
            $_POST['mdp'] = htmlspecialchars($_POST['mdp']);

            $user = new Data();
            $username = $user->verficiation_username();

            if ($username) {
                $errors = [];
                foreach ($username as $user) {
                    if (password_verify($_POST['mdp'], $user['password'])) {
                        $_SESSION['utilisateur'] = $_POST['pseudo'];
                        unset($errors);
                        header('Location:/');
                        die();
                    } else {
                        $errors[0] = 'Entrez des infos valides';
                        $errors[1] = 'Entrez des infoos valides';
                    }
                }
            } else {
                $errors[0] = 'Entrez des infos valides';
                $errors[1] = 'Entrez des infoos valides';
            }
        }

        require_once __DIR__ . '/../views/connexion.php';
    }

    //Deconnexion
    public function deconnexion()
    {
        unset($_SESSION['admin'], $_SESSION['utilisateur']);
        header('location:/');
    }

    // Presentation de la structure
    public function presentation()
    {
        require_once __DIR__ . '/../views/presentation.html';
    }

    //Les differents articles
    public function articles()
    {

        $articles = new Data();
        $count = $articles->count_articles();

        if (isset($_GET['page'])) {
            $page = htmlspecialchars($_GET['page']);
            $page = intval($page);
            if ($page == 0) {
                $page = 1;
            }
        } else {
            $page = 1;
        }

        $nb_articles_page = 5;
        $nb_page = ceil($count / $nb_articles_page);

        if ($page > $nb_page) {
            $page = 1;
        }

        $debut =  ($page - 1) * $nb_articles_page;

        $articles = $articles->takeAll($debut, $nb_articles_page);
        require_once __DIR__ . '/../views/articles.php';
    }

    //Listing d'un article et affichage des commentaires
    public function article()
    {
        if (isset($_GET['id'])) {
            $_GET['id'] = htmlspecialchars($_GET['id']);
            $_GET['id'] = intval($_GET['id']);

            if ($_GET['id'] == 0) {
                $_GET['id'] = 1;
            }
            $articlecomments = new Data();

            $article = $articlecomments->takeOne();
            if (!$article) {
                $error_id = 'Aucun article correspondant a cet identifiant ';
            }

            if (isset($_POST['commentaire'])) {
                if (strlen($_POST['commentaire']) <= 9) {
                    $error = 'Commentaire doit contenir au moins 10 caraccteres';
                } else {
                    $_POST['commentaire'] = htmlspecialchars($_POST['commentaire']);
                    $articlecomments->insertcomment();
                }
            }

            $comments = $articlecomments->takeComments();
            if (!$comments) {
                $no_comments = 'Soyez le premier a commenter';
            }
            require_once __DIR__ . '/../views/article.php';
        } else {
            $not_id = 'Veuillez preciser l\'identifiant de l\'article';
            require_once __DIR__ . '/../views/article.php';
        }
    }

    //Fonction pour la partie contact
    public function contact()
    {
        $fichier_contact = '../commentaires/contact.txt';
        if (isset($_POST['nom']) && isset($_POST['motif']) && isset($_POST['message'])) {
            $nom = htmlspecialchars($_POST['nom']);
            $motif = htmlspecialchars($_POST['motif']);
            $message = htmlspecialchars($_POST['message']);

            if (strlen($nom) <= 3) {
                $error_nom = 'Nom trop court';
            }

            if (strlen($motif) <= 7) {
                $error_motif = 'Motif trop court';
            }

            if (strlen($message) <= 10) {
                $error_message = 'Message trop court';
            }

            if (empty($error_message) && empty($error_motif) && empty($error_nom)) {
                commentaires($fichier_contact, $nom, $motif, $message);
                $succes = 'Commentaire bien envoye';
            }
        }

        require_once __DIR__ . '/../views/contact.php';
    }

    // Postuler pour un poste d'ecrivain
    public function postuler()
    {
        require_once __DIR__ . '/../views/postuler.html';
    }

    // Formulaire d'administration
    public function adminformulaire()
    {
        if (isset($_POST['id']) && isset($_POST['mdp'])) {
            $_POST['id'] = htmlspecialchars($_POST['id']);
            $_POST['mdp'] = htmlspecialchars($_POST['mdp']);
            $admin = new Data();
            $admin = $admin->verficiation_admin();

            if ($admin) {
                if (password_verify($_POST['mdp'], $admin['password'])) {
                    $_SESSION['admin'] = 1;
                    header("Location:/admin/admin/p?page=1");
                    die();
                }
            }
        }
        require_once __DIR__ . '/../views/formulaireadmin.html';
    }

    // Affichage des articles et possibilites de modifications
    public function admin()
    {
        if (isset($_SESSION['admin'])) {
            $administrator = new Data();
            $count = $administrator->count_articles();

            if (isset($_GET['page'])) {
                $page = htmlspecialchars($_GET['page']);
                $page = intval($page);
                if ($page == 0) {
                    $page = 1;
                }
            } else {
                $page = 1;
            }

            $nb_articles_page = 8;
            $nb_page = ceil($count / $nb_articles_page);

            if ($page > $nb_page) {
                $page = 1;
            }

            $debut =  ($page - 1) * $nb_articles_page;

            $articles = $administrator->takeAll($debut, $nb_articles_page);

            require_once __DIR__ . '/../views/admin.php';
        } else {
            header('location:/');
        }
    }

    // edition d'un article
    public function editer()
    {
        if (isset($_POST['title']) && isset($_POST['body'])) {
            $_POST['title'] = htmlspecialchars($_POST['title']);
            $_POT['body'] = htmlspecialchars($_POST['body']);
            $update = new Data();
            $update->update();
            header('location:/admin/admin/p');
            die();
        }
        if (isset($_SESSION['admin'])) {
            if (isset($_GET['id'])) {
                $_GET['id'] = htmlspecialchars($_GET['id']);
                $_GET['id'] = intval($_GET['id']);
                if ($_GET['id'] == 0) {
                    header('location:/');
                }
                $article = new Data();
                $article = $article->takeOne();
                if (!$article) {
                    header('location:/');
                    die();
                }
                require_once __DIR__ . '/../views/editer.php';
            }
        } else {
            header('location:/');
        }
    }

    //suppression d'un article
    public function delete()
    {
        if (isset($_SESSION['admin'])) {
            if (isset($_GET['id'])) {
                $_GET['id'] = htmlspecialchars($_GET['id']);
                $_GET['id'] = intval($_GET['id']);
                if ($_GET['id'] == 0) {
                    header('location:/');
                    die();
                }
                $delete = new Data();
                $delete = $delete->delete();

                if (!$delete) {
                    header('location:/');
                    die();
                }

                header('location:/admin/admin/p');
            } else {
                header('location:/');
            }
        } else {
            header('location:/');
        }
    }
}
