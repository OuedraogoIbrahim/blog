<?php

declare(strict_types=1);

function initialisation()
{
    $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    return $pdo;
}
