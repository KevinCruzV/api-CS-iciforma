<?php
/**
 * headers
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/**
 * Env var
 */
/*require_once "../vendor/autoload.php";
/*require_once '../config/env.php';


/**
 * Request verification Method
 */
if($_SERVER['REQUEST_METHOD'] == 'GET')
{

    if(!isset($_SERVER['HTTP_X_API_KEY']))
    {

        header("WWW-Authenticate: X-ApiKey realm=\"Private\"");
        header("HTTP/1.0 401 Unauthorized");
        echo json_encode([
            "message" => "No Api Key"
        ]);

    }elseif($_SERVER['HTTP_X_API_KEY'] == '4d96e221-3eb6-4db2-a216-a04a58ccacdf')
    {


        /**
         *  config files & access
         */
        include_once '../Database.php';
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
         * get data
         */
        $stmt = $lead->read();

        /**
         * verification if it has at least one lead
         */
        if($stmt->rowCount() > 0)
        {
            /**
             * It will push data in an assoc tab to transform it in json data.
             * Tab initialisation
             */
            $tabLeads = [];
            $tabLeads['lead'] = [];

            /**
             * traverse the array.
             */
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                $Lead = [
                    "id" => $id,
                    "civilite" => $civilite,
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "tel" => $tel,
                    "email" => $email,
                    "ville" => $ville,
                    "code_postal" => $code_postal,
                    "statut" => $statut,
                    "horaire_rappel" => $horaire_rappel,
                    "formation_ou_client" => $formation_ou_client,
                    "id_client" => $id_client,
                    "created_at" => $created_at,
                    "update_at" => $update_at
                ];

                $tabLeads['lead'][] = $Lead;

            }
            /**
             * It work correctly so http response 200
             */
            http_response_code(200);

            /**
             * Encode data in json
             */
            echo json_encode($tabLeads);

        }else {
            /**
             * No content http response 204
             */
            http_response_code(204);
            echo json_encode([
                "message" => "No Content"
            ]);
        }
    }else
    {
        header("WWW-Authenticate: X-ApiKey realm=\"Private\"");
        header("HTTP/1.0 401 Unauthorized");
        echo json_encode([
            "message" => "Wrong Key"
        ]);
    }

}
else
{
    /**
     * Request error
     */
    http_response_code(405);
    echo json_encode([
        "message" => "Method not allowed"
    ]);
}