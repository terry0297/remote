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

if(!empty($data['prenom']) && !empty($data['nom']) && !empty($data['email'])) {
    http_response_code(201);
///////// APPEL DES METHODES ///////////
include ('../cnx.php');
include ('../classe/clientmanager.php');
include ('../classe/client.php');
       
$client = new Client();
	$client->setPrenom($data['prenom']);
	$client->setNom($data['nom']);
	$client->setEmail($data['email']);
		
$manager = new ClientManager($cnx);
$manager->CreateClient($client);

$message = array(
    'msg' => 'Insersion reussis!'
    );
    echo json_encode ($message);
///////// APPEL DES METHODES ///////////

///////// RETOUR API KO ///////////

} else {
    http_response_code (400);
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
        