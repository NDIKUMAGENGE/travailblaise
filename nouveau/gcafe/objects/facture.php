<?php
class Facture
{

    // database connection and table name
    private $conn;
    private $table_name = "facture";

    // object properties
    public $id;
    public $created;
    public $num_fact;
    public $date_c;
    public $num_dossier;
    public $montant_base;
    public $tva;
    public $honoraires;
    public $statut;
    
  
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
                    num_fact=:num_fact, num_dossier=:num_dossier, montant_base=:montant_base";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->num_fact = htmlspecialchars(strip_tags($this->num_fact));
        $this->num_dossier = htmlspecialchars(strip_tags($this->num_dossier));
        $this->montant_base = htmlspecialchars(strip_tags($this->montant_base));
        
        // to get time-stamp for 'created' field
       // $this->timestamp = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":num_fact", $this->num_fact);
        $stmt->bindParam(":num_dossier", $this->num_dossier);
        $stmt->bindParam(":montant_base", $this->montant_base);
        
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
                    id = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->num_fact = $row['num_fact'];
        $this->num_dossier = $row['num_dossier'];
        $this->montant_base = $row['montant_base'];
        $this->date_c = $row['date_c'];
		
    }

    function update()
    {
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                num_fact = :num_fact,
                num_dossier = :num_dossier,
                montant_base = :montant_base
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->num_fact = htmlspecialchars(strip_tags($this->num_fact));
        $this->num_dossier = htmlspecialchars(strip_tags($this->num_dossier));
        $this->montant_base = htmlspecialchars(strip_tags($this->montant_base));
       
		$this->id = htmlspecialchars(strip_tags($this->id));
		

        // bind parameters
        $stmt->bindParam(':num_fact', $this->num_fact);
        $stmt->bindParam(':num_dossier', $this->num_dossier);
        $stmt->bindParam(':montant_base', $this->montant_base);
       
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
          p.id, p.num_fact, p.num_dossier, p.montant_base
            FROM
                " . $this->table_name . " p
          
            WHERE
                p.num_fact LIKE ? OR p.num_dossier LIKE ?
            ORDER BY
                p.num_fact ASC
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
                p.num_fact LIKE ?";

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
