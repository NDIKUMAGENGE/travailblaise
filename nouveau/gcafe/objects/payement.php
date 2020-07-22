<?php
class Payement
{

    // database connection and table name
    private $conn;
    private $table_name = "payement";

    // object properties
    public $id;
    public $num_fact;
    public $date;
    public $title;
    public $montant;
    

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
                    num_fact=:num_fact, title=:title, montant=:montant";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->num_fact = htmlspecialchars(strip_tags($this->num_fact));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->montant = htmlspecialchars(strip_tags($this->montant));
        

        // to get time-stamp for 'created' field
        //$this->timestamp = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":num_fact", $this->num_fact);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":montant", $this->montant);
       

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
                    id= ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_dossier);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->num_fact = $row['num_fact'];
        $this->title = $row['title'];
        $this->montant = $row['montant'];
        
    }

    
    function readAllone($from_record_num, $records_per_page)
    {
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                    WHERE
                    num_fact= ?
               
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
                    num_fact = :num_fact,
                    title = :title,
                    montant = :montant
                   
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->num_fact = htmlspecialchars(strip_tags($this->num_fact));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->montant = htmlspecialchars(strip_tags($this->montant));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind parameters
        $stmt->bindParam(":num_fact", $this->num_fact);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":montant", $this->montant);
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
            p.id, p.num_fact, p.title, p.montant, p.date
            FROM
                " . $this->table_name . " p
               
            WHERE
                p.num_fact LIKE ? OR p.date LIKE ?
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
