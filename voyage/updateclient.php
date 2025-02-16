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
   if(!empty($data['clientID']) && !empty($data['prenom']) && !empty($data['nom']) && !empty($data['email'])
 ) {
   http_response_code(200);
///////// APPEL DES METHODES ///////////
include('../cnx.php');
include('../classe/client.php');
include('../classe/clientmanager.php');

$client = new Client();
$client->setClientID($data['clientID']);
$client->setPrenom($data['prenom']);
$client->setNom($data['nom']);
$client->setEmail($data['email']);

$manager = new ClientManager($cnx);
$manager->updateClient($client);

$message = array (
    'msg' => 'Modification reussis. Nous n\' autorisons pas les modifications des clients 1 et 2'
    );
    echo json_encode ($message);
///////// RETOUR API OK ///////////
} else {
///////// RETOUR API KO ///////////
    http_response_code(400);
    $message = array (
        'msgErreur' => 'Veuillez remplir tous les champs '
        );
    echo json_encode($message);
   }
} else {
    http_response_code(405);
    $message = array (
        'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode PUT'
        );
    echo json_encode($message);
///////// RETOUR API KO ////////////
}
