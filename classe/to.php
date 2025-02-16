<?php
class Touroperato {
    private $toID;
    private $name;

  public function getToID() {
    return $this->tutoID ;
  }
  public function getName() {
    return $this->name ;
  }
  public function setToID ($toID) {
      $toID= intval ($toID);
      if(is_int(toID)){
        $this->toID = $toID;
    }
  }
  public function setName ($name) {
    if(is_string($name)){
      $this->name = $name;
    }
  }
}