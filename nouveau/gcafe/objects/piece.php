<?php
class Piece
{

    // database connection and table name
    private $conn;
    private $table_name = "piece";

    // object properties
    public $id;
    public $nom;
    public $created;
    public $pathP;
    public $id_dossier;
    

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
                    nom=:nom, pathP=:pathP, id_dossier=:id_dossier";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->pathP = htmlspecialchars(strip_tags($this->pathP));
        $this->id_dossier = htmlspecialchars(strip_tags($this->id_dossier));
        

        // to get time-stamp for 'created' field
        //$this->timestamp = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":pathP", $this->pathP);
        $stmt->bindParam(":id_dossier", $this->id_dossier);
       

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

    function readOne()
    {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id_dossier = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_dossier);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nom = $row['nom'];
        $this->pathP = $row['pathP'];
        $this->id_dossier = $row['id_dossier'];
        
    }

    
    function readAllone($from_record_num, $records_per_page)
    {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                    WHERE
                    id_dossier = ?
               
                ORDER BY
                    id desc
                LIMIT
                    {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    function update()
    {
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nom = :nom,
                    pathP = :pathP,
                    id_dossier = :id_dossier
                   
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->pathP = htmlspecialchars(strip_tags($this->pathP));
        $this->id_dossier = htmlspecialchars(strip_tags($this->id_dossier));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind parameters
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":pathP", $this->pathP);
        $stmt->bindParam(":id_dossier", $this->id_dossier);
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
            p.id, p.nom, p.pathP, p.id_dossier
            FROM
                " . $this->table_name . " p
               
            WHERE
                p.nom LIKE ? OR p.id_dossier LIKE ?
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
