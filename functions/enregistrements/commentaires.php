<?php

declare(strict_types=1);

function commentaires($fichier, $nom,  $motif, $commentaire)
{
    if (!file_exists($fichier)) {
        $file = fopen($fichier, "w");
        fputs($file, date('d-M-y') . ' : ' . $nom . ' : ' . $motif . ' : ' . $commentaire);
        fclose($file);
    } else {
        $file = fopen($fichier, "a");
        fputs($file, "\n" . date('d-M-y') . ' : ' . $nom . ' : ' . $motif . ' : ' . $commentaire);
        fclose($file);
    }
}
