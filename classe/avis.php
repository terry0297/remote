<?php
class Avis {
    private $avisID;
    private $avis ;
    private $toID;

    private $clientID;
    private $prenom;
    private $nom;
    private $email;

    private $voyageID;
    private $titre ;
    private $presentation ;
    
    public function getAvisID() {
        return $this->avisID ;
    }
    public function getAvis() {
        return $this->avis ;
    }
    public function getVoyageID() {
      return $this->voyageID ;
    }
    public function getTitre() {
      return $this->titre ;
    }
    public function getPresentation() {
        return $this->presentation ;
    }
    public function getClientID() {
      return $this->clientID ;
    }
    public function getPrenom() {
      return $this->prenom ;
    }
    public function getNom() {
        return $this->nom ;
    }
    public function getEmail() {
        return $this->email ;
    }
    public function getToID() {
      return $this->toID ;
    }
    public function setAvisID ($avisID){
        $avisID= intval ($avisID);
        if(is_int($avisID)){
            $this->avisID = $avisID;
          }
    }
    public function setAvis ($avis){
      if(is_string($avis)){
        $this->avis = $avis;
      }
    }
    public function setVoyageID ($voyageID){
      $voyageID = intval ($voyageID);
      if(is_int($voyageID)){
          $this->voyageID = $voyageID;
        }
    }
    public function setTitre ($titre){
      if(is_string($titre)){
        $this->titre = $titre;
      }
    }
    public function setPresentation ($presentation){
      if (is_string ($presentation)){
      $this->presentation = $presentation;
      }
    }
    public function setClientID ($clientID){
      $clientID= intval ($clientID);
      if(is_int($clientID)){
          $this->clientID = $clientID;
        }
    }
    public function setPrenom ($prenom){
      if(is_string($prenom)){
        $this->prenom = $prenom;
      }
    }
    public function setNom ($nom){
      if(is_string($nom)){
      $this->nom = $nom;
    }
    }
    public function setEmail ($email){
      if(is_string($email)){
        $this->email = $email;
      }
    }
    public function setToID ($toID){
      $toID= intval ($toID);
      if(is_int($toID)){
          $this->toID = $toID;
        }
    } 
}