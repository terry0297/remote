<?php
class AvisManager {
    private $cnx;

    public function __construct($cnx) {
        $this->setCnx($cnx) ;
    }
/************** INSERT AVIS ****************/
    public function CreateAvis (Avis $avis){
        $sql = 'INSERT INTO avis 
                ( avis, voyageID, clientID, toID) VALUES
                ( :avis, :voyageID, :clientID, 1)';
        $req = $this->cnx->prepare($sql);
        $req->bindValue(':avis', $avis->getAvis(), PDO::PARAM_STR);
        $req->bindValue(':voyageID', $avis->getVoyageID(), PDO::PARAM_INT);
        $req->bindValue(':clientID', $avis->getClientID(), PDO::PARAM_INT);
        
        $req->execute();
        }

/************** INSERT AVIS ****************/
/************** AFFICHER UN AVIS ****************/
    public function ReadAvis($id) {
        $sql = 'SELECT * FROM avis AS a
                JOIN client AS c
                ON a.clientID = c.clientID
                JOIN voyage AS v
                ON a.voyageID = v.voyageID
                WHERE a.avisID = :id AND a.toID = 1';
            $req= $this->cnx->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $count = $req->rowCount();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $avis = new Avis ();

            if ($count > 0) {
                $avis->setavisID ($data['avisID']);
                $avis->setavis ($data ['avis']);
                $avis->setVoyageID ($data ['voyageID']);
                $avis->setClientID ($data ['clientID']);
                $avis->setPrenom ($data ['prenom']);
                $avis->setNom ($data ['nom']);
                $avis->setEmail ($data ['email']);
                $avis->setTitre ($data ['titre']);
                $avis->setPresentation ($data ['presentation']);
                
            } else {
                $avis->setavisID ($id);
                $avis->setavis ('aucun avis enregistré');
                $avis->setVoyageID ('voyage');
                $avis->setClientID ('clientID');
                

            }

            return $avis;
        }

/************** AFFICHER UN AVIS ****************/
/************** AFFICHER TOUS LES AVIS ****************/
    public function ReadAllAvis() {
        $sql = 'SELECT * FROM avis AS a
                JOIN client AS c
                ON a.clientID = c.clientID
                JOIN voyage AS v
                ON a.voyageID = v.voyageID
                WHERE a.toID = 1';
        $req = $this->cnx->prepare($sql);
        $req -> execute ();

        while ($data = $req->fetch (PDO::FETCH_ASSOC)) {
            $avis = new Avis ();
            $avis->setAvisID ($data['avisID']);
            $avis->setAvis ($data ['avis']);
            $avis->setVoyageID ($data ['voyageID']);
            $avis->setClientID ($data ['clientID']);
            $avis->setPrenom ($data ['prenom']);
            $avis->setNom ($data ['nom']);
            $avis->setEmail ($data ['email']);
            $avis->setTitre ($data ['titre']);
            $avis->setPresentation ($data ['presentation']);
            $aviss [] = $avis;
        }
        return $aviss;
    }
/************** AFFICHER TOUS LES AVIS ****************/
/************** COMPTER LES AVIS ****************/
    public function CompterAvis() {
        $sql = 'SELECT COUNT(*) AS compter FROM avis';
        $req = $this->cnx->prepare ($sql);
        $req -> execute ();
        $data = $req->fetch (PDO::FETCH_ASSOC);
        return $data['compter'];
    }
/************** COMPTER LES AVIS ****************/
/************** MODIFIER UN AVIS ****************/
    public function UpdateAvis (Avis $avis ){
        if ($avis->getAvisID() > 2) {

            $sql = 'UPDATE avis SET avis = :avis, 
            voyageID = :voyageID, clientID = :clientID
            WHERE avisID = :avisID AND toID = 1';
            $req = $this->cnx->prepare ($sql);
            $req->bindValue(':avis', $avis->getAvis(), PDO::PARAM_STR);
            $req->bindValue(':voyageID', $avis->getVoyageID(), PDO::PARAM_INT);
            $req->bindValue(':clientID', $avis->getClientID(), PDO::PARAM_INT);
            $req->bindValue(':avisID', $avis->getAvisID(), PDO::PARAM_INT);
            $req->execute();
        }
    }  
/************** MODIFIER UN AVIS ****************/
/************** SUPPRIMER UN AVIS ****************/
    public function DeleteAvis ($id) {
        if ($id > 2) {
        $sql = 'DELETE FROM avis
        WHERE avisID = :id AND toID = 1';
        $req = $this->cnx->prepare ($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute(); 
        }
    }
/************** SUPPRIMER UN AVIS ****************/
/************** PDO ****************/
    private function setCnx($cnx) {
        $this->cnx = $cnx;
    }
}