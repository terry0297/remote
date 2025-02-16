<?php
///////// ZONE DE CONTROLE ///////////
header ('Access-Control-Allow-Origin:*');
header ('Content-Type:application/json; charset=UTF-8');
header ('Access-Control-Allow-Methods: PUT');
header ('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Auhtorization,x-Requested-Whith');
///////// ZONE DE CONTROLE ///////////

if ($_SERVER ['REQUEST_METHOD'] == 'PUT'){
///////// RETOUR API OK ///////////
///////// TRAITEMENT DES INFOS RECUS ///////////
$data = json_decode(file_get_contents("php://input"), true);
if(!empty($data['voyageID']) && !empty($data['titre']) && !empty($data['presentation'])) {
   http_response_code(200);
///////// APPEL DES METHODES ///////////
include('../cnx.php');
include('../classe/voyage.php');
include('../classe/voyagemanager.php');

$voyage = new Voyage();
$voyage->setVoyageID($data['voyageID']);
$voyage->setTitre($data['titre']);
$voyage->setPresentation($data['presentation']);

$manager = new VoyageManager($cnx);
$manager->updateVoyage($voyage);

$message = array (
    'msg' => 'Modification reussis , Nous n\'autorisons pas les modifications des voyages 1 et 2'
    );
    echo json_encode ($message);
    ///////// RETOUR API OK ///////////
   } else {
///////// RETOUR API KO //////////
    http_response_code (405);
    $message = array (
        'msgErreur' => 'Veuillez remplir tous les champs'
    );
echo json_encode ($message);
    
    }
} else {
    http_response_code(405);
    $message = array (
        'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode PUT'
        );
    echo json_encode($message);
///////// RETOUR API KO //////////
}