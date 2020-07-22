<?php
class Personne
{

    // database connection and table name
    private $conn;
    private $table_name = "avocat";

    // object properties
    public $id;
    public $nom;
    public $prenom;
    public $sexe;
    public $etatcivil;
    public $nationalite;
    public $telephone;
    public $mail;
    public $adresse;
    public $created;
    public $modified;
    public $ville;
    public $role;
    public $password;
    public $active;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create product
    function create()
    {
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nom=:nom, prenom=:prenom, sexe=:sexe, 
     etatcivil=:etatcivil, nationalite=:nationalite, telephone=:telephone, mail=:mail, adresse=:adresse
     , ville=:ville , password=:password , role=:role";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->sexe = htmlspecialchars(strip_tags($this->sexe));
        $this->etatcivil = htmlspecialchars(strip_tags($this->etatcivil));
        $this->nationalite = htmlspecialchars(strip_tags($this->nationalite));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->adresse = htmlspecialchars(strip_tags($this->adresse));
        $this->ville = htmlspecialchars(strip_tags($this->ville));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role = htmlspecialchars(strip_tags($this->role));
        // to get time-stamp for 'created' field
       // $this->timestamp = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":sexe", $this->sexe);
        $stmt->bindParam(":etatcivil", $this->etatcivil);
        $stmt->bindParam(":nationalite", $this->nationalite);
		$stmt->bindParam(":telephone", $this->telephone);
		$stmt->bindParam(":mail", $this->mail);
		$stmt->bindParam(":adresse", $this->adresse);
        $stmt->bindParam(":ville", $this->ville);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll($from_record_num, $records_per_page)
    {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // used for paging products
    public function countAll()
    {
        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }



 // used by select drop-down list
 function read()
 {
     //select all data
     $query = "SELECT
                 id,nom,prenom,telephone
             FROM
                 " . $this->table_name . "
             ORDER BY
                 nom";

     $stmt = $this->conn->prepare($query);
     $stmt->execute();

     return $stmt;
 }





    function readOne()
    {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->sexe = $row['sexe'];
        $this->etatcivil = $row['etatcivil'];
		$this->nationalite = $row['nationalite'];
		$this->telephone = $row['telephone'];
		$this->mail = $row['mail'];
        $this->adresse = $row['adresse'];
        $this->ville = $row['ville'];
        $this->password = $row['password'];
        $this->role = $row['role'];
    }

    function update()
    {
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nom = :nom,
                    prenom = :prenom,
                    sexe = :sexe,
                    etatcivil  = :etatcivil,
				    nationalite  = :nationalite,
                    telephone  = :telephone,
                    mail  = :mail,
					adresse  = :adresse,
                    ville  = :ville,
                    password  = :password,
                    role  = :role
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->sexe = htmlspecialchars(strip_tags($this->sexe));
        $this->etatcivil = htmlspecialchars(strip_tags($this->etatcivil));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
		$this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->adresse = htmlspecialchars(strip_tags($this->adresse));
        $this->ville = htmlspecialchars(strip_tags($this->ville));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role = htmlspecialchars(strip_tags($this->role));
		$this->id = htmlspecialchars(strip_tags($this->id));
		

        // bind parameters
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':sexe', $this->sexe);
        $stmt->bindParam(':etatcivil', $this->etatcivil);
		$stmt->bindParam(':nationalite', $this->nationalite);
		$stmt->bindParam(':telephone', $this->telephone);
		$stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':adresse', $this->adresse);
        $stmt->bindParam(':ville', $this->ville);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete the product
    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // read products by search term
    public function search($search_term, $from_record_num, $records_per_page)
    {

        // select query
        $query = "SELECT
          p.id, p.nom, p.prenom, p.sexe, p.etatcivil, p.nationalite, p.telephone, p.mail, p.adresse
            FROM
                " . $this->table_name . " p
          
            WHERE
                p.name LIKE ? OR p.prenom LIKE ?
            ORDER BY
                p.name ASC
            LIMIT
                ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }

    public function countAll_BySearch($search_term)
    {

        // select query
        $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " p
                
            WHERE
                p.nom LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }
}
