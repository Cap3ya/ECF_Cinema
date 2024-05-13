<?php

use Model\entity\Offre;
use Model\repository\OffreDAO;

$message = null;
$offre = null;
$offreDao = new OffreDAO();

if (isset($_POST['id'])) {
    $offre = $offreDao::getOne($_POST['id']);
}
if (isset($_POST['title']) && isset($_POST['description'])) {
    $offre = new Offre($_POST['id'], $_POST['title'], $_POST['description']);
    $status = $offreDao::UpdateOne($offre);
    $message = $status ?  "Update OK" : "Erreur Update";
}
echo $twig->render('update.html.twig', [
    'message' => $message,
    'offre' => $offre
]);
