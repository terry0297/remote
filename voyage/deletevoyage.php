<?php
///////// ZONE DE CONTROLE ///////////
header ('Access-Control-Allow-Origin:*');
header ('Content-Type:application/json; charset=UTF-8');
header ('Access-Control-Allow-Methods: DELETE');
header ('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Auhtorization,x-Requested-Whith');
///////// ZONE DE CONTROLE ///////////

if ($_SERVER ['REQUEST_METHOD'] == 'DELETE') {
///////// RETOUR API OK ///////////
$data = json_decode(file_get_contents("php://input"), true);

    if(!empty($data['voyageID']) ){
///////// APPEL DES METHODES ///////////
        include ('../cnx.php');
        include ('../classe/voyage.php');
        include ('../classe/voyagemanager.php');

        $manager = new Voyagemanager($cnx);
        $verif   = $manager->ReadVoyage($data['voyageID']);

        if(!empty($verif->getVoyageID())){
            http_response_code(200);

            $manager->DeleteVoyage($data['voyageID']);

            $message = array (
                'msg' => 'Suppression reussis, Nous n\'autorisons pas la supression des voyages 1 et 2'
                );
            echo json_encode ($message);
///////// RETOUR API KO ///////////

        } else {
            http_response_code(405);
            $message = array (
                'msg' => 'Supression impossible. Identifiant inexistant'
                );
            echo json_encode($message);

        } 
    } else {
            http_response_code(405);
            $message = array(
                'msgErreur'   => 'Une erreur est survenue !',
                'explication' => 'L\'identifiant est obligatoire'
            );
            echo json_encode($message);
        }
    
} else {
    http_response_code(405);
    $message = array (
        'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode DELETE'
        );
    echo json_encode($message);
///////// RETOUR API KO ///////////
}
