<?php
class Session 
{
    public function __construct()
    {
        session_start();
    }
    
    public function getPseudo($nomAttribut)
    {
        return $_SESSION[$nomAttribut];
    }

    public function setPseudo($nomAttribut, $valeurAttribut)
    {
        $_SESSION[$nomAttribut] = $valeurAttribut;
    }
}

$Session = new Session();

