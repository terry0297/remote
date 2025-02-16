<?php
///////// ZONE DE CONTROLE ///////////
header ('Access-Control-Allow-Origin:*');
header ('Content-Type:application/json; charset=UTF-8');
header ('Access-Control-Allow-Methods: POST');
header ('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Auhtorization,x-Requested-Whith');
///////// ZONE DE CONTROLE ///////////

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
///////// RETOUR API OK ///////////
    
///////// TRAITEMENT DES INFOS RECUS ///////////
    $data = json_decode(file_get_contents("php://input"), true);
    
    if(!empty($data['avis']) && !empty($data['voyageID']) && !empty($data['clientID'])) {
        http_response_code(201);
///////// APPEL DES METHODES ///////////
        include ('../cnx.php');
        include ('../classe/avismanager.php');
        include ('../classe/avis.php');
           
        $avis = new Avis();
            $avis->setAvis($data['avis']);
            $avis->setVoyageID($data['voyageID']);
            $avis->setClientID($data['clientID']);
                
        $manager = new AvisManager($cnx);
        $manager->CreateAvis ($avis);
        
        $message = array(
            'msg' => 'Insersion reussis!'
            );
            echo json_encode ($message);
///////// APPEL DES METHODES ///////////
    
///////// RETOUR API KO ///////////
    
    } else {
        http_response_code (405);
        $message = array (
            'msgErreur' => 'Veuillez remplir tous les champs'
        );
    echo json_encode ($message);
        
    }
    
    } else {
        http_response_code(405);
        $message = array (
            'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode POST'
            );
        echo json_encode($message);
///////// RETOUR API KO ///////////
}
            