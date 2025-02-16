<?php
class ClientManager {
    private $cnx;

    public function __construct($cnx) {
        $this->setCnx($cnx) ;
    }
/************** INSERT CLIENT ****************/
    public function CreateClient (Client $client){
        $sql = 'INSERT INTO client 
                (prenom, nom, email, toID) VALUES
                (:prenom, :nom, :email, 1)';
        $req = $this->cnx->prepare($sql);
        $req->bindValue(':prenom', $client->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':nom', $client->getNom(), PDO::PARAM_STR);
        $req->bindValue(':email', $client->getEmail(), PDO::PARAM_STR);
        $req->execute();
    }

/************** INSERT CLIENT ****************/
/************** AFFICHER UN CLIENT ****************/
    public function ReadClient($id) {
        $sql = 'SELECT * FROM client
                WHERE clientID = :id AND toID = 1';
            $req= $this->cnx->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $count = $req->rowCount();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $client = new Client();

            if ($count > 0){
                $client->setClientID ($data['clientID']);
                $client->setPrenom ($data ['prenom']);
                $client->setNom ($data ['nom']);
                $client->setEmail ($data ['email']); 
            } else {
            $client->setClientID ($id);
            $client->setPrenom ('Prenom');
            $client->setNom ('Nom');
            $client->setEmail ('PrenomNom@eamil.com');
            }

            return $client;
    }
/************** AFFICHER UN CLIENT ****************/
/************** AFFICHER TOUS LES CLIENTS ****************/
    public function ReadAllClient() {
        $sql = 'SELECT * FROM client
            WHERE toID = 1';
        $req = $this->cnx->prepare($sql);
        $req -> execute ();

        while ($data = $req->fetch (PDO::FETCH_ASSOC)) {
            $client = new Client();
            $client->setClientID ($data['clientID']);
            $client->setPrenom ($data ['prenom']);
            $client->setNom ($data ['nom']);
            $client->setEmail ($data ['email']);
            $clients [] = $client;
        }
        return $clients;
    }
/************** AFFICHER TOUS LES CLIENTS ****************/
/************** COMPTER LES CLIENTS ****************/
    public function CompterClient() {
        $sql = 'SELECT COUNT(*) AS compter FROM client';
        $req = $this->cnx->prepare ($sql);
        $req -> execute ();
        $data = $req->fetch (PDO::FETCH_ASSOC);
        return $data['compter'];
    }
/************** COMPTER LES CLIENTS ****************/
/************** MODIFIER UN CLIENT ****************/
    public function UpdateClient (Client $client ){
        if ($client->getClientID() > 2) {
            $sql = 'UPDATE client SET prenom = :prenom, 
            nom = :nom, email = :email
            WHERE clientID = :clientID AND toID = 1';
            $req = $this->cnx->prepare ($sql);
            $req->bindValue(':prenom', $client->getPrenom(), PDO::PARAM_STR);
            $req->bindValue(':nom', $client->getNom(), PDO::PARAM_STR);
            $req->bindValue(':email', $client->getEmail(), PDO::PARAM_STR);
            $req->bindValue(':clientID', $client->getClientID(), PDO::PARAM_INT);
            $req -> execute();
        }
    }  
/************** MODIFIER UN CLIENT ****************/
/************** SUPPRIMER UN CLIENT ****************/
    public function DeleteClient ($id) {
        if ($id > 2) {
            $sql = 'DELETE FROM client
            WHERE clientID = :id AND toID = 1';
            $req = $this->cnx->prepare ($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute(); 
        } 
    }
/************** SUPPRIMER UN CLIENT ****************/
/************** PDO ****************/
    private function setCnx($cnx) {
        $this->cnx = $cnx;
    }
}