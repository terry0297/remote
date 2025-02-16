<?php
///////// ZONE DE CONTROLE ///////////
header ('Access-Control-Allow-Origin:*');
header ('Content-Type:application/json; charset=UTF-8');
header ('Access-Control-Allow-Methods: PUT');
header ('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Auhtorization,x-Requested-Whith');
///////// ZONE DE CONTROLE ///////////


if ($_SERVER ['REQUEST_METHOD'] == 'PUT') {
///////// RETOUR API OK ///////////
    
///////// TRAITEMENT DES INFOS RECUS ///////////
    $data = json_decode(file_get_contents("php://input"), true);
    if(!empty($data['avis']) && !empty($data['voyageID']) && !empty($data['clientID']) && !empty($data['avisID'])){
    http_response_code(200);
///////// APPEL DES METHODES ///////////
    include('../cnx.php');
    include('../classe/avis.php');
    include('../classe/avismanager.php');

    $avis = new Avis();
    $avis->setAvis($data['avis']);
    $avis->setVoyageID($data['voyageID']);
    $avis->setClientID($data['clientID']);
    $avis->setAvisID($data['avisID']);
  

    $manager = new AvisManager($cnx);
    $manager->updateAvis($avis);

    $message = array (
        'msg' => 'Modification reussis, Nous n\'autorisons pas les modifications des avis 1 et 2'
        );
        echo json_encode ($message);
///////// RETOUR API OK ///////////
    } else {
        http_response_code(405);
        $message = array (
            'msgErreur' => 'Veuillez remplire tous les champs'
            );
        echo json_encode($message);
    }
///////// RETOUR API KO ///////////
} else {
        http_response_code(405);
        $message = array (
            'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode PUT'
            );
        echo json_encode($message);
///////// RETOUR API KO ///////////
    }
