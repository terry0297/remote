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
if(!empty($data['clientID']) ){
///////// APPEL DES METHODES ///////////
      include ('../cnx.php');
      include ('../classe/client.php');
      include ('../classe/clientmanager.php');
            
      $manager = new ClientManager($cnx);
      $verif = $manager->ReadClient($data['clientID']);
            
        if(!empty($verif->getClientID())) {
            http_response_code(200);

            $manager->DeleteClient($data['clientID']);

            $message = array (
              'msg' => 'Suppression reussis. Nous autorisons pas la supression des clients dont l\'identifiant unique est 1 ou 2. '
              );
            echo json_encode ($message);
        } else {
      ///////// RETOUR API KO ///////////

              http_response_code(405);
              $message = array (
                  'msg' => 'Supression impossible. Identifiant inexistant'
              );
              echo json_encode ($message);
            } 
        } else {
              http_response_code(405);
              $message = array(
              'msg' => 'Supression impossible. Identifiant obligatoire'
              );
              echo json_encode ($message);
          }

} else {
    http_response_code(405);
    $message = array (
        'msgErreur' => 'Méthode non autorisée , vous devez utiliser la methode DELETE'
        );
    echo json_encode($message);
///////// RETOUR API KO ///////////
}
