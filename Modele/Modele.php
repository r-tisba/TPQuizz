<?php

class Modele 
{
    protected function getBDD()
    {
        // INITIALISATION DE LA CONNEXION A LA BDD
        return new PDO('mysql:host=localhost;dbname=tpquiz;charset=UTF8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}
