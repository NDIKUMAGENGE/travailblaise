<?php


class Bon_de_livraison
{

    private $_id;
    private $_date;
    private $_id_facture;


    /**
     * Product constructor.
     * @param $_id
     * @param $_date
     * @param $_id_facture
     *
     */

    public function __construct($_id, $_date, $_id_facture)
    {
        $this->_id = $_id;
        $this->_name = $_date;
        $this->_price = $_id_facture;

    }

    /*
    public function __construct($_name, $_price, $_description, $_reference, $_qtityStock, $_rating, $_image)
    {
        $this->_date = $_date;
        $this->_id_facture = $_id_facture;

    // }*/

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $name
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return mixed
     */
    public function getIdFacture()
    {
        return $this->_id_facture;
    }

    /**
     * @param mixed $price
     */
    public function setIdFacture($id_facture)
    {
        $this->_id_facture = $id_facture;
    }

    /**
     * @return mixed
     */
    }