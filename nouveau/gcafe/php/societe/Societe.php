<?php


class Societe
{

    private $_id;
    private $_nom;
    private $_adresse;
    private $_tel;
    private $_fax;
    private $_mail;
    private $_matricule_fiscale;



    public function __construct($_id, $_nom, $_adresse, $_tel, $_fax, $_mail, $_matricule_fiscale)
    {
        $this->_id = $_id;
        $this->_nom = $_nom;
        $this->_adresse = $_adresse;
        $this->_tel = $_tel;
        $this->_fax = $_fax;
        $this->_mail = $_mail;
        $this->_matricule_fiscale = $_matricule_fiscale;
    }

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
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->_adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->_adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->_tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($_tel)
    {
        $this->_tel = $_tel;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->_fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($_fax)
    {
        $this->_fax = $_fax;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($_mail)
    {
        $this->_mail = $_mail;
    }

    /**
     * @return mixed
     */
    public function getMatricule_fiscale()
    {
        return $this->_matricule_fiscale;
    }

    /**
     * @param mixed $matricule_fiscale
     */
    public function setMatricule_fiscale($_matricule_fiscale)
    {
        $this->_matricule_fiscale = $_matricule_fiscale;
    }

}