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
        // Ex�cute une requ�te de type SELECT avec une clause WHERE, et retourne un objet Product.
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
        // Pr�paration de la requ�te d'insertion.

        $req = $this->_db->prepare('INSERT INTO societe SET nom = :nom, adresse = :adresse, tel = :tel,
        fax = :fax, mail = :mail, matricule_fiscale = :matricule_fiscale');

        $req->bindValue(':nom', $societe->getNom(), PDO::PARAM_STR);
        $req->bindValue(':adresse', $societe->getAdresse(), PDO::PARAM_STR);
        $req->bindValue(':tel', $societe->getTel(), PDO::PARAM_STR);
        $req->bindValue(':fax', $societe->getFax(), PDO::PARAM_STR);
        $req->bindValue(':mail', $societe->getMail(), PDO::PARAM_STR);
        $req->bindValue(':matricule_fiscale', $societe->getMatricule_fiscale(), PDO::PARAM_STR);

        //PARAM_INT if int

        // Ex�cution de la requ�te.
        $req->execute();

    }

    public function deleteSociete($id)
    {
        // Ex�cute une requ�te de type DELETE.
        $this->_db->exec('DELETE FROM societe WHERE id = '.$id);
    }

    /*
    public function deleteProduct($product)
    {
        // Ex�cute une requ�te de type DELETE.
        $this->_db->exec('DELETE FROM product WHERE id = '.$product->getId());
    }
*/

    public function updateProduct(Product $product)
    {
        // Pr�pare une requ�te de type UPDATE.
        // Assignation des valeurs � la requ�te.
        // Ex�cution de la requ�te.
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
?>