<?php
/**
 * headers
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/**
 * Request verification Method
 */
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /**
     *  config files & access
     */
    include_once '../config/Database.php';
    include_once '../hook/function.php';
    include_once '../models/Lead.php';

    /**
     * db instantiation
     */
    $database = new Database();
    $db = $database->getConnection();

    /**
     * lead instantiation
     */
    $lead = new Lead($db);

    /**
     * Get the json datas in the post request
     */
    $datas = json_decode(file_get_contents('php://input'));

    /**
     * Datas empty verification
     */
    if(!empty($datas->civilite) && !empty($datas->nom) && !empty($datas->prenom) && !empty($datas->tel) && !empty($datas->email) && !empty($datas->ville)
        && !empty($datas->code_postal) && !empty($datas->statut) && !empty($datas->horaire_rappel) && !empty($datas->formation_ou_client) && !empty($datas->id_client))
    {
        /**
         * civilite verification
         * statut verification
         * horaire_rappel verification
         */
//        if(verifCivilite($datas->civilite) && verifStatut($datas->statut) && verifHoraire($datas->horaire_rappel))
//        {

            $lead->civilite = $datas->civilite;
            $lead->nom = $datas->nom;
            $lead->prenom = $datas->prenom;
            $lead->tel = $datas->tel;
            $lead->email = $datas->email;
            $lead->ville = $datas->ville;
            $lead->code_postal = $datas->code_postal;
            $lead->statut = $datas->statut;
            $lead->horaire_rappel = $datas->horaire_rappel;
            $lead->formation_ou_client = $datas->formation_ou_client;
            $lead->id_client = $datas->id_client;

            if($lead->create())
            {
                /**
                 * sucess request
                 */
                http_response_code(200);
                echo json_encode([
                   "message" => "lead ajouté"
                ]);

            }else
            {
                /**
                 * not a sucess request
                 */
                http_response_code(503);
                echo json_encode([
                    "message" => "Service unavailable"
                ]);
            }
//        }else
//        {
//            http_response_code(400);
//            echo json_encode([
//                "message" => "Bad request - Bad data format. See also civilite or statut or horaire_rappel"
//            ]);
//        }

    } else
    {
        /**
         * Request error
         */
        http_response_code(400);
        echo json_encode([
            "message" => "Body empty"
        ]);

    }

}else
{
    /**
     * Request error
     */
    http_response_code(405);
    echo json_encode([
        "message" => "Method not allowed"
    ]);
}