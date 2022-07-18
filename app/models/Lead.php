<?php
class Lead {
    /**
     *  $connexion
     * Connexion db
     */
    private mixed $connexion;
    /**
     * @var string $table
     * Db table
     */
    private string $table = "lead";


    /**
     * object properties
     */

    public int $id;
    public string $civilite;
    public string $nom;
    public string $prenom;
    public string $tel;
    public string $email;
    public string $ville;
    public string $code_postal;
    public string $statut;
    public string $horaire_rappel;
    public string $formation_ou_client;
    public string $id_client;
    public string $created_at;
    public string $update_at;

    /**
     * @param $db
     */
    public function __construct($db)
    {
        $this->connexion = $db;
    }

    /**
     * @return mixed
     * read leads
     */
    public function read(): mixed
    {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";

        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }

    /**
     * @return PDOStatement|bool
     * read one lead
     */
    public function read_one(): PDOStatement|bool
    {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC WHERE id_client = ? LIMIT 0,1";

        $query = $this->connexion->prepare($sql);

        $query->bindParam(1, $this->id_client);

        $query->execute();

        return $query;
    }

    /**
     * @return bool
     * create a lead
     */
    public function create(): bool
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

