<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class Valorationa implements EntityInterface {
    private $idvalorationa;
    private $nickname;
    private $idanswer;
    private $valoration;
    private $date;

    //----------Data base Values---------------------------------------
    private static $tableName = "valorationa";
    private static $colNameIdvalorationa = "idvalorationa";
    private static $colNameNickname = "nickname";
    private static $colNameIdanswer = "idanswer";
    private static $colNameValoration = "valoration";
    private static $colNameDate = "date";

    public function __construct() {

    }

    public function getIdvalorationa() {
        return $this->idvalorationa;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getIdanswer() {
        return $this->idanswer;
    }

    public function getValoration() {
        return $this->valoration;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdvalorationa($idvalorationa) {
        $this->idvalorationa = $idvalorationa;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function setIdanswer($idanswer) {
        $this->idanswer = $idanswer;
    }

    public function setValoration($valoration) {
        $this->valoration = $valoration;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getAll() {
        $data = array();
        $data["idvalorationa"] = $this->idvalorationa;
        $data["nickname"] = $this->nickname;
        $data["idanswer"] = $this->idanswer;
        $data["valoration"] = $this->valoration;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($idvalorationa, $nickname, $idanswer, $valoration, $date) {
        $this->setIdvalorationa($idvalorationa);
        $this->setNickname($nickname);
        $this->setIdanswer($idanswer);
        $this->setValoration($valoration);
        $this->setDate($date);
    }

    /* public function toString() {
      $toString = "Review[idvalorationa=" . $this->idvalorationa . "][nickname=" . $this->nickname . "][desciption=" . $this->nick . "]";
      return $toString;
      } */
}

?>
