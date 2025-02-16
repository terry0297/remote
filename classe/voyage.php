<?php
class Voyage {
    private $voyageID;
    private $titre ;
    private $presentation ;
    private $toID;
    
    public function getVoyageID() {
        return $this->voyageID ;
    }
    public function getTitre() {
        return $this->titre ;
    }
    public function getPresentation() {
        return $this->presentation ;
    }
    public function getToID() {
       return $this->toID;
    }
    public function setVoyageID ($voyageID){
        $voyageID= intval ($voyageID);
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
    public function setToID ($toID){
        $toID= intval ($toID);
        if(is_int($toID)){
          $this->toID = $toID;
        }
    }
}