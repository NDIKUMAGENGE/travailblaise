<?php
class Agriculteur
{

    // database connection and table name
    private $conn;
    private $table_name = "agriculteur";

    // object properties
    public $id;
    public $cni;
    public $nom;
    public $prenom;
    public $sexe;
    public $etatcivil;
    public $nationalite;
    
    public $province;
    public $commune;
public $colline;
public $mandateur;
    public $telephone;
    public $created;
    public $modified;
    
    public $role;
    public $password;
    public $active;
    public $numero_compte;
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
                cni=:cni, nom=:nom, prenom=:prenom, sexe=:sexe, 
     etatcivil=:etatcivil, nationalite=:nationalite, province=:province, commune=:commune, colline=:colline
     , mandateur=:mandateur , telephone=:telephone, numero_compte=:numero_compte";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->cni = htmlspecialchars(strip_tags($this->n_identite));
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->sexe = htmlspecialchars(strip_tags($this->sexe));
        $this->etatcivil = htmlspecialchars(strip_tags($this->etatcivil));
        $this->nationalite = htmlspecialchars(strip_tags($this->nationalite));
        $this->province = htmlspecialchars(strip_tags($this->province));
        $this->commune = htmlspecialchars(strip_tags($this->commune));
        $this->colline = htmlspecialchars(strip_tags($this->colline));
        $this->mandateur = htmlspecialchars(strip_tags($this->mandateur));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
        $this->numero_compte = htmlspecialchars(strip_tags($this->numero_compte));
        
        // to get time-stamp for 'created' field
       // $this->timestamp = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":cni", $this->cni);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":sexe", $this->sexe);
        $stmt->bindParam(":etatcivil", $this->etatcivil);
        $stmt->bindParam(":nationalite", $this->nationalite);
		$stmt->bindParam(":province", $this->province);
		$stmt->bindParam(":commune", $this->commune);
		$stmt->bindParam(":colline", $this->colline);
        $stmt->bindParam(":mandateur", $this->mandateur);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":numero_compte", $this->numero_compte);
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



    // used by select drop-down list
    function read()
    {
        //select all data
        $query = "SELECT
                    id,nom,prenom,cni
                FROM
                    " . $this->table_name . "
                ORDER BY
                    nom";

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

    function readOne()
    {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    cni = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->cni = $row['cni'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->sexe = $row['sexe'];
        $this->etatcivil = $row['etatcivil'];
		$this->nationalite = $row['nationalite'];
		$this->province = $row['province'];
		$this->commune = $row['commune'];
        $this->colline = $row['colline'];
        $this->mandateur = $row['mandateur'];
        $this->telephone = $row['telephone'];
        $this->numero_compte = $row['numero_compte'];
        
       
    }

    function update()
    {
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                cni=:cni,
                 nom=:nom,
                  prenom=:prenom,
                   sexe=:sexe, 
     etatcivil=:etatcivil,
      nationalite=:nationalite,
       province=:province,
        commune=:commune,
         colline=:colline
     , mandateur=:mandateur,
      telephone=:telephone,
       numero_compte=:numero_compte
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->cni = htmlspecialchars(strip_tags($this->n_identite));
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->sexe = htmlspecialchars(strip_tags($this->sexe));
        $this->etatcivil = htmlspecialchars(strip_tags($this->etatcivil));
        $this->nationalite = htmlspecialchars(strip_tags($this->nationalite));
        $this->province = htmlspecialchars(strip_tags($this->province));
        $this->commune = htmlspecialchars(strip_tags($this->commune));
        $this->colline = htmlspecialchars(strip_tags($this->colline));
        $this->mandateur = htmlspecialchars(strip_tags($this->mandateur));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
        $this->numero_compte = htmlspecialchars(strip_tags($this->numero_compte));
		$this->id = htmlspecialchars(strip_tags($this->id));
		

        // bind parameters
        $stmt->bindParam(":cni", $this->cni);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":prenom", $this->prenom);
        $stmt->bindParam(":sexe", $this->sexe);
        $stmt->bindParam(":etatcivil", $this->etatcivil);
        $stmt->bindParam(":nationalite", $this->nationalite);
		$stmt->bindParam(":province", $this->province);
		$stmt->bindParam(":commune", $this->commune);
		$stmt->bindParam(":colline", $this->colline);
        $stmt->bindParam(":mandateur", $this->mandateur);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":numero_compte", $this->numero_compte);
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
          p.id,p.cni, p.nom, p.prenom, p.sexe, p.etatcivil, p.nationalite, p.province, p.commune, p.colline,
          p.mandateur, p.numero_compte
            FROM
                " . $this->table_name . " p
          
            WHERE
                p.cni LIKE ? OR p.nom LIKE ?
            ORDER BY
                p.nom ASC
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
