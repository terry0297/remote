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

if(!empty ($data['titre']) && !empty ($data['presentation'])){
http_response_code(201);
///////// APPEL DES METHODES ///////////
include ('../cnx.php');
include ('../classe/voyagemanager.php');
include ('../classe/voyage.php');

$voyage = new Voyage();
    
    $voyage->setTitre($data['titre']);
    $voyage->setPresentation($data['presentation']);

$manager = new VoyageManager($cnx);
$manager->CreateVoyage($voyage);

$message = array(
    'msg' => 'Insersion reussis!'
    );
    echo json_encode ($message);
///////// APPEL DES METHODES ///////////
} else {
///////// RETOUR API KO ///////////
        http_response_code (405);
        $message = array (
            'msgErreur' => 'Veuillez remplir tous les champs'
        );
    echo json_encode ($message);

}
///////// RETOUR API KO ///////////
} else {
     http_response_code(405);
     $message = array (
        'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode POST'
        );
    echo json_encode($message);
///////// RETOUR API KO ///////////
}