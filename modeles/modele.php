<?php
function getBDD()
{
    // INITIALISATION DE LA CONNEXION A LA BDD
    return new PDO('mysql:host=localhost;dbname=tpquiz;charset=UTF8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

require_once "../modeles/utilisateurs.php";
require_once "../modeles/questionsSecretes.php";