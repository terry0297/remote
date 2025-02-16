<?php
class VoyageManager {
    private $cnx;

    public function __construct($cnx){
        $this->setCnx($cnx);
    }
/************** INSERT VOYAGE ****************/
    public function CreateVoyage (Voyage $voyage) {
        $sql = 'INSERT INTO voyage
                (toID, titre, presentation) VALUES
                ( 1, :titre, :presentation )';
        $req = $this->cnx->prepare($sql);
        $req->bindValue(':titre', $voyage->getTitre(),PDO::PARAM_STR);
        $req->bindValue(':presentation',$voyage->getPresentation(),PDO::PARAM_STR);
        $req->execute();
    }

/************** INSERT VOYAGE ****************/
/************** AFFICHER UN VOYAGE ****************/
    public function ReadVoyage ($id) {
        $sql = 'SELECT * FROM voyage
                WHERE voyageID = :id AND toID = 1 ';
        $req = $this->cnx->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        $count = $req->rowCount();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $voyage = new Voyage();

        if ($count > 0) {
            $voyage->setVoyageID($data['voyageID']);
            $voyage->setTitre($data['titre']);
            $voyage->setPresentation($data['presentation']);
        } else {
        $voyage->setVoyageID($id);
        $voyage->setTitre('Titre');
        $voyage->setPresentation('Aucune voyage enregistré');
        }
        return $voyage ;
    }
/************** AFFICHER UN VOYAGE VOYAGE ****************/
/************** AFFICHER TOUS LES VOYAGES ****************/
    public function ReadAllVoyage() {
        $sql = 'SELECT * FROM voyage
                WHERE toID = 1';
        $req = $this->cnx->prepare($sql);
        $req -> execute ();

        while ($data = $req->fetch (PDO::FETCH_ASSOC)) {
            $voyage = new Voyage();
            $voyage->setVoyageID ($data['voyageID']);
            $voyage->setTitre ($data ['titre']);
            $voyage->setPresentation ($data ['presentation']);
            $voyages [] = $voyage;
        }
        return $voyages;
    }
/************** AFFICHER TOUS VOYAGES ****************/
/************** COMPTER TOUS LES VOYAGES ****************/
    public function CompterVoyage() {
        $sql = 'SELECT COUNT(*) AS compter FROM voyage';
        $req = $this->cnx->prepare ($sql);
        $req -> execute ();
        $data = $req->fetch (PDO::FETCH_ASSOC);
        return $data ['compter'];
    }
/************** COMPTER TOUS LES VOYAGES ****************/
/************** MODIFIER UN VOYAGE ****************/
    public function UpdateVoyage (Voyage $voyage){
        if ($voyage->getVoyageID() > 2) {
            $sql = 'UPDATE voyage SET
            titre = :titre, presentation = :presentation
            WHERE voyageID = :voyageID AND toID = 1';
            $req =$this->cnx->prepare($sql);
            $req->bindValue(':titre',$voyage->getTitre(),PDO::PARAM_STR);
            $req->bindValue(':presentation',$voyage->getPresentation(),PDO::PARAM_STR);
            $req->bindValue(':voyageID',$voyage->getVoyageID(),PDO::PARAM_INT);
            $req->execute();
        }
    }
/************** MODIFIER UN VOYAGE ****************/
/************** SUPRIMER UN VOYAGE ****************/
    public function DeleteVoyage ($id){
        if ($id > 2) {
            $sql = 'DELETE FROM voyage 
            WHERE voyageID = :id AND toID = 1';
            $req = $this->cnx->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
        }
    }
/************** SUPRIMER UN VOYAGE ****************/
/************** PDO ****************/
    private function setCnx($cnx){
        $this->cnx = $cnx;
    }
}