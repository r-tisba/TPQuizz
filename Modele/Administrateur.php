<?php 
class Administrateur extends Utilisateur
{
   public function getPseudo()
   {
       return $this->pseudo;
   } 

   private $bannis; 
   public function setBannis($pseudo)
   {
       $this->bannis[] = $pseudo;
   }

   public function getBannis()
   {
       return $this->bannis;
   }
}