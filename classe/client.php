<?php
class Client {
      private $clientID;
      private $prenom;
      private $nom;
      private $email;
      private $toID;

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
          return $this->toID;
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
        public function setToID ($toID) {
          $toID= intval ($toID);
          if(is_int($toID)){
            $this->toID = $toID;
          }
      }
 }
