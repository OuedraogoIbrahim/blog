<?php

declare(strict_types=1);

namespace App\models;

require_once __DIR__ . '/../functions/database/database.php';

use PDO;

class Data
{

    // *************************************************************************************************

    public function insert()
    {
        $pdo = initialisation();
        $insert = $pdo->prepare('INSERT INTO `utilisateurs` (pseudo , password , email) 
                            VALUES (:pseudo , :mdp , :email)');
        $insert->bindParam(':pseudo', $_POST['pseudo']);
        $insert->bindParam(':mdp', $_POST['mdp']);
        $insert->bindParam(':email', $_POST['email']);
        $insert->execute();
    }

    //Utiliser au niveau de la **fonction INSCRIPTION** du controller

    // *************************************************************************************************

    public function verficiation_username()
    {
        $pdo = initialisation();
        $username = $pdo->prepare('SELECT pseudo , password FROM `utilisateurs` WHERE pseudo = :pseudo');
        $username->bindParam(':pseudo', $_POST['pseudo']);
        $username->execute();
        $username = $username->fetchAll(pdo::FETCH_ASSOC);
        return $username;
    }

    //Utiliser au niveau de la **fonction CONNEXION** du controller

    //************************************************************************************************

    public function count_articles()
    {
        $pdo = initialisation();
        $count = $pdo->query('SELECT COUNT(id) FROM articles');
        $count = $count->fetch(pdo::FETCH_NUM);
        $count = $count[0];
        return $count;
    }

    public function takeAll($debut, $nb_articles)
    {
        $pdo = initialisation();
        $all = $pdo->query("SELECT * FROM articles ORDER BY id DESC LIMIT $debut , $nb_articles");
        $all = $all->fetchAll(pdo::FETCH_ASSOC);
        return $all;
    }

    //Utiliser au niveau de la **fonction ARTICLES** du controller

    //************************************************************************************************

    public function takeOne()
    {
        $pdo = initialisation();
        $one = $pdo->prepare('SELECT * FROM articles WHERE id = :id');
        $one->bindParam(':id', $_GET['id'], pdo::PARAM_INT);
        $one->execute();
        $one = $one->fetch(pdo::FETCH_ASSOC);
        return $one;
    }

    //************************************************************************************************

    public function verficiation_admin()
    {
        $pdo = initialisation();
        $admin = $pdo->prepare('SELECT * FROM administration WHERE identifiant = :ident');
        $admin->bindParam(':ident', $_POST['mdp']);
        $admin->execute();
        $admin = $admin->fetch(pdo::FETCH_ASSOC);
        return $admin;
    }

    //************************************************************************************************

    public function delete()
    {
        $pdo = initialisation();
        $delete = $pdo->prepare('DELETE FROM articles WHERE id = :id');
        $delete->bindParam(':id', $_GET['id']);
        $delete->execute();
    }

    //************************************************************************************************

    public function  update()
    {
        $pdo = initialisation();
        $update = $pdo->prepare('UPDATE articles SET titre = :title , corps = :body WHERE id = :id');
        $update->bindParam(':id', $_GET['id']);
        $update->bindParam(':title', $_POST['title']);
        $update->bindParam(':body', $_POST['body']);
        $update->execute();
    }

    //************************************************************************************************
    public function takeComments()
    {
        $pdo = initialisation();
        $comments = $pdo->prepare('SELECT comment,utilisateur,created_at FROM commentaires WHERE article_id = :id ORDER BY id DESC');
        $comments->bindParam(':id', $_GET['id'], pdo::PARAM_INT);
        $comments->execute();
        $comments = $comments->fetchAll(pdo::FETCH_ASSOC);
        return $comments;
    }

    //************************************************************************************************

    public function insertcomment()
    {
        $pdo = initialisation();
        $comment = $pdo->prepare('INSERT INTO commentaires (comment , utilisateur , article_id) VALUES (:comment , :utilisateur , :article_id)');
        $comment->bindParam(':comment', $_POST['commentaire']);
        $comment->bindParam(':utilisateur', $_SESSION['utilisateur']);
        $comment->bindParam(':article_id', $_GET['id'], pdo::PARAM_INT);
        $comment->execute();
    }
}
