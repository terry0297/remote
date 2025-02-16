<?php
///////// ZONE DE CONTROLE ///////////
header ('Access-Control-Allow-Origin:*');
header ('Content-Type:application/json; charset=UTF-8');
header ('Access-Control-Allow-Methods: GET');
header ('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Auhtorization,x-Requested-Whith');
///////// ZONE DE CONTROLE ///////////

if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
///////// RETOUR API OK ///////////
    http_response_code(200);
///////// APPEL DES METHODES ///////////
    include ('../cnx.php');
    include ('../classe/avismanager.php');
    include ('../classe/avis.php');

    $manager = new AvisManager($cnx);
    $avis = $manager->ReadAllAvis();
    $count   = $manager->CompterAvis();

///////// APPEL DES METHODES ///////////

///////// ENVOIS DES DONNEES EN JSON ///////////
    if ( $count > 0){
        foreach ($avis as $aviss) {
            $msg = array (
                'avisID'    => $aviss->getAvisID(),
                'avis'      => $aviss->getAvis(),
                'voyageID'  => $aviss->getVoyageID(),
                'clientID'  => $aviss->getClientID(),
                'client'    => [
                    'Prenom'    => $aviss->getPrenom(),
                    'Nom'       => $aviss->getNom(),
                    'Email'     => $aviss->getEmail()   

                ],
                'voyage'    => [
                    'Titre'         => $aviss->getTitre(),
                    'Presentation'  => $aviss->getPresentation()  
                ]
            );
            $message [] = $msg;
        }
        echo json_encode ($message);
    }
///////// ENVOIS DES DONNEES EN JSON ///////////

///////// RETOUR API OK ///////////
}
else {
///////// RETOUR API KO ///////////
        http_response_code(405);
        $message = array (
            'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode GET'
        );
        echo json_encode($message);
///////// RETOUR API KO ////////////
}
    