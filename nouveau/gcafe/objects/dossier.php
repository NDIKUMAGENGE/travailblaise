<?php
class Dossier
{

    // database connection and table name
    private $conn;
    private $table_name = "dossier";

    // object properties
    public $id;
    public $created;
    public $num_dossier;
    public $e1_type_doss;
    public $reference;
    public $benificiaire;
    public $accuser;
    public $contreb_adr;
    public $e1_trubunal;
     public $e1_ville;
   public $id_avocat;
    
  //secondaire
    public $e1_heure;
    public $e1_date_dec;
    //
    public $e1_reference_trub;
    public $e1_txt_jugement;
    public $e1_sale_num;
    public $section;
    public $e2_cours_apel;
    public $e2_ville;
    public $e2_reference_cour;
    public $e3_reference;
    public $e3_txt_sent;
    public $c_judiciaire;
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
                    num_dossier=:num_dossier, e1_type_doss=:e1_type_doss, reference=:reference, 
                    benificiaire=:benificiaire, accuser=:accuser, contreb_adr=:contreb_adr, e1_tribunal=:e1_tribunal, e1_ville=:e1_ville, id_avocat=:id_avocat";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->num_dossier = htmlspecialchars(strip_tags($this->num_dossier));
        $this->e1_type_doss = htmlspecialchars(strip_tags($this->e1_type_doss));
        $this->reference = htmlspecialchars(strip_tags($this->reference));
        $this->benificiaire = htmlspecialchars(strip_tags($this->benificiaire));
        $this->accuser = htmlspecialchars(strip_tags($this->accuser));
        $this->contreb_adr = htmlspecialchars(strip_tags($this->contreb_adr));
        $this->e1_tribunal = htmlspecialchars(strip_tags($this->e1_tribunal));
        $this->e1_ville = htmlspecialchars(strip_tags($this->e1_ville));
        $this->id_avocat = htmlspecialchars(strip_tags($this->id_avocat));
 
        // to get time-stamp for 'created' field
       // $this->timestamp = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":num_dossier", $this->num_dossier);
        $stmt->bindParam(":e1_type_doss", $this->e1_type_doss);
        $stmt->bindParam(":reference", $this->reference);
        $stmt->bindParam(":benificiaire", $this->benificiaire);
        $stmt->bindParam(":accuser", $this->accuser);
		$stmt->bindParam(":contreb_adr", $this->contreb_adr);
		$stmt->bindParam(":e1_tribunal", $this->e1_tribunal);
        $stmt->bindParam(":e1_ville", $this->e1_ville);
        $stmt->bindParam(":id_avocat", $this->id_avocat);
        



        



     
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
                     id,num_dossier,reference
                 FROM
                     " . $this->table_name . "
                 ORDER BY
                     num_dossier";
 
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

        $this->num_dossier = $row['num_dossier'];
        $this->e1_type_doss = $row['e1_type_doss'];
        $this->reference = $row['reference'];
        $this->benificiaire = $row['benificiaire'];
		$this->accuser = $row['accuser'];
		$this->contreb_adr = $row['contreb_adr'];
		$this->e1_tribunal = $row['e1_tribunal'];
        $this->e1_ville = $row['e1_ville'];
        $this->id_avocat = $row['id_avocat'];
    }

    function update()
    {
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                num_dossier=:num_dossier,
                e1_type_doss=:e1_type_doss,
                  reference=:reference, 
                benificiaire=:benificiaire,
                 accuser=:accuser,
                  contreb_adr=:contreb_adr,
                   e1_tribunal=:e1_tribunal,
                    e1_ville=:e1_ville,
                    id_avocat=:id_avocat
                WHERE
                    id = :id";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->num_dossier = htmlspecialchars(strip_tags($this->num_dossier));
        $this->e1_type_doss = htmlspecialchars(strip_tags($this->e1_type_doss));
        $this->reference = htmlspecialchars(strip_tags($this->reference));
        $this->benificiaire = htmlspecialchars(strip_tags($this->benificiaire));
        $this->accuser = htmlspecialchars(strip_tags($this->accuser));
        $this->contreb_adr = htmlspecialchars(strip_tags($this->contreb_adr));
        $this->e1_tribunal = htmlspecialchars(strip_tags($this->e1_tribunal));
        $this->e1_ville = htmlspecialchars(strip_tags($this->e1_ville));
        $this->id_avocat = htmlspecialchars(strip_tags($this->id_avocat));

        // bind parameters
        $stmt->bindParam(":num_dossier", $this->num_dossier);
        $stmt->bindParam(":e1_type_doss", $this->e1_type_doss);
        $stmt->bindParam(":reference", $this->reference);
        $stmt->bindParam(":benificiaire", $this->benificiaire);
        $stmt->bindParam(":accuser", $this->accuser);
		$stmt->bindParam(":contreb_adr", $this->contreb_adr);
		$stmt->bindParam(":e1_tribunal", $this->e1_tribunal);
        $stmt->bindParam(":e1_ville", $this->e1_ville);
        $stmt->bindParam(":id_avocat", $this->id_avocat);
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
          p.id, p.num_dossier, p.type_dossier, p.reference, p.benificiaire, p.accuser, p.contreb_adr, p.e1_tribunal, p.e1_ville,p.id_avocat

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
