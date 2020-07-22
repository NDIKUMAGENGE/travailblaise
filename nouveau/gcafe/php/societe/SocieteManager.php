<?php
require_once('Societe.php');

/** GestionProduct **/
class SocieteManager
{

    private $_db; // Instance de PDO.

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getSociete($id)
    {
        // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Product.
        $id = (int) $id;

        $req = $this->_db->query('SELECT * FROM societe WHERE id ='.$id);
        $res = $req->fetch();


        return new Societe($res['id'],$res['nom'],$res['adresse'],
            $res['tel'], $res['fax'],$res['mail'],
            $res['matricule_fiscale']);
    }

    /**
     * @return array
     */
    public function getListSociete()
    {
        // Retourne la liste de tous les products.

        $societes = [];

        $req = $this->_db->query('SELECT * FROM societe');

        while ($res = $req->fetch())
        {
            $societes[] = new Societe($res['id'],$res['nom'],$res['adresse'],
                $res['tel'], $res['fax'],$res['mail'],
                $res['matricule_fiscale']);
        }


        return $societes;
    }


    public function addSociete(Societe $societe)
    {
        // Préparation de la requête d'insertion.

        $req = $this->_db->prepare('INSERT INTO societe SET nom = :nom, adresse = :adresse, tel = :tel,
        fax = :fax, mail = :mail, matricule_fiscale = :matricule_fiscale');

        $req->bindValue(':nom', $societe->getNom(), PDO::PARAM_STR);
        $req->bindValue(':adresse', $societe->getAdresse(), PDO::PARAM_STR);
        $req->bindValue(':tel', $societe->getTel(), PDO::PARAM_STR);
        $req->bindValue(':fax', $societe->getFax(), PDO::PARAM_STR);
        $req->bindValue(':mail', $societe->getMail(), PDO::PARAM_STR);
        $req->bindValue(':matricule_fiscale', $societe->getMatricule_fiscale(), PDO::PARAM_STR);

        //PARAM_INT if int

        // Exécution de la requête.
        $req->execute();

    }

    public function deleteSociete($id)
    {
        // Exécute une requête de type DELETE.
        $this->_db->exec('DELETE FROM societe WHERE id = '.$id);
    }

    /*
    public function deleteProduct($product)
    {
        // Exécute une requête de type DELETE.
        $this->_db->exec('DELETE FROM product WHERE id = '.$product->getId());
    }
*/

    public function updateProduct(Product $product)
    {
        // Prépare une requête de type UPDATE.
        // Assignation des valeurs à la requête.
        // Exécution de la requête.
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
?>