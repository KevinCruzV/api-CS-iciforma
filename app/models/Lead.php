<?php
class Lead {
    /**
     * @var $connexion
     * connexion db
     */
    private $connexion;
    /**
     * @var string $table
     * Db table
     */
    private $table = "lead";


    /**
     * object properties
     */

    public $id;
    public $civilite;
    public $nom;
    public $prenom;
    public $tel;
    public $email;
    public $ville;
    public $code_postal;
    public $statut;
    public $horaire_rappel;
    public $formation_ou_client;
    public $id_client;
    public $created_at;
    public $update_at;

    /**
     * @param $connexion
     */
    public function __construct($db)
    {
        $this->connexion = $db;
    }

    /**
     * @return mixed
     * read leads
     */
    public function read()
    {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";

        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }

    /**
     * @return mixed
     * read one lead
     */
    public function read_one()
    {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC WHERE id_client = ? LIMIT 0,1";

        $query = $this->connexion->prepare($sql);

        $query->bindParam(1, $this->id_client);

        $query->execute();

        return $query;
    }

    /**
     * @return void
     * create a lead
     */
    public function create()
    {
        $sql = "INSERT INTO " . $this->table . " SET civilite=:civilite, nom=:nom, prenom=:prenom, tel=:tel, email=:email, ville=:ville,
        code_postal=:code_postal, statut=:statut, horaire_rappel=:horaire_rappel, formation_ou_client=:formation_ou_client, id_client=:id_client";

        $query = $this->connexion->prepare($sql);

        /**
         * protection of the data
         */
        $this->civilite=htmlspecialchars(strip_tags($this->civilite));
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->tel=htmlspecialchars(strip_tags($this->tel));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->ville=htmlspecialchars(strip_tags($this->ville));
        $this->code_postal=htmlspecialchars(strip_tags($this->code_postal));
        $this->statut=htmlspecialchars(strip_tags($this->statut));
        $this->horaire_rappel=htmlspecialchars(strip_tags($this->horaire_rappel));
        $this->formation_ou_client=htmlspecialchars(strip_tags($this->formation_ou_client));
        $this->id_client=htmlspecialchars(strip_tags($this->id_client));


        $query->bindParam(":civilite", $this->civilite);
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":prenom", $this->prenom);
        $query->bindParam(":tel", $this->tel);
        $query->bindParam(":email", $this->email);
        $query->bindParam(":ville", $this->ville);
        $query->bindParam(":code_postal", $this->code_postal);
        $query->bindParam(":statut", $this->statut);
        $query->bindParam(":horaire_rappel", $this->horaire_rappel);
        $query->bindParam(":formation_ou_client", $this->formation_ou_client);
        $query->bindParam(":id_client", $this->id_client);

        if($query->execute())
        {
            return true;
        }
        return false;

    }


}

