<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class Valorationq implements EntityInterface {

    private $idvalorationq;
    private $nickname;
    private $idquestion;
    private $valoration;
    private $date;

     //----------Data base Values---------------------------------------
    private static $tableName = "valorationq";
    private static $colNameIdvalorationq = "idvalorationq";
    private static $colNameNickname = "nickname";
    private static $colNameIdquestion = "idquestion";
    private static $colNameValoration = "valoration";
    private static $colNameDate = "date";
    
    public function __construct() {
        
    }

    public function getIdvalorationq() {
        return $this->idvalorationq;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getIdquestion() {
        return $this->idquestion;
    }

    public function getValoration() {
        return $this->valoration;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdvalorationq($idvalorationq) {
        $this->idvalorationq = $idvalorationq;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function setIdquestion($idquestion) {
        $this->idquestion = $idquestion;
    }

    public function setValoration($valoration) {
        $this->valoration = $valoration;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getAll() {
        $data = array();
        $data["idvalorationq"] = $this->idvalorationq;
        $data["nickname"] = $this->nickname;
        $data["idquestion"] = $this->idquestion;
        $data["valoration"] = $this->valoration;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($idvalorationq, $nickname, $idquestion, $valoration, $date) {
        $this->setIdvalorationq($idvalorationq);
        $this->setValoration($nickname);
        $this->setIdquestion($idquestion);
        $this->setValoration($valoration);
        $this->setDate($date);
    }

    /* public function toString() {
      $toString = "Review[idvalorationq=" . $this->idvalorationq . "][nickname=" . $this->nickname . "][desciption=" . $this->nick . "]";
      return $toString;
      } */
}

?>
