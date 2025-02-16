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
    include ('../classe/clientmanager.php');
    include ('../classe/client.php');

    $manager = new ClientManager($cnx);
    $clients= $manager -> ReadAllClient ();
    $count = $manager->CompterClient();
///////// APPEL DES METHODES ///////////

///////// ENVOIS DES DONNEES EN JSON ///////////
    if ($count > 0) {
        foreach ($clients as $client) {
            $msg = array (
                'clientID'=> $client->getClientID(),
                'prenom' => $client->getPrenom(),
                'nom'    => $client->getNom(),
                'email'  => $client->getEmail()

            );
            $messages[]= $msg;
        }
        echo json_encode ($messages);
///////// ENVOIS DES DONNEES EN JSON ///////////

///////// RETOUR API OK ///////////

    } else {
///////// RETOUR API KO ///////////
        http_response_code(405);
        $message = array (
            'msgErreur' => 'Aucune donnée enregistrée'
        );
        echo json_encode ($message);
///////// RETOUR API KO ///////////
    }


} else {
///////// RETOUR API KO ///////////
    http_response_code(405);
    $message = array (
        'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode GET'
    );
    echo json_encode($message);
///////// RETOUR API KO ///////////
}
