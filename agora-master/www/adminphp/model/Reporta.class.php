<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  Vath
 * version 2017/04
 */
require_once "EntityInterface.php";

class Reporta implements EntityInterface {

    private $idreporta;
    private $nickname;
    private $idanswer;
    private $reporttext;
    private $date;

     //----------Data base Values---------------------------------------
    private static $tableName = "repota";
    private static $colNameIdreporta = "idreporta";
    private static $colNameNickname = "nickname";
    private static $colNameIdanswer = "idanswer";
    private static $colNameReporttext = "reporttext";
    private static $colNameDate = "date";
    
    public function __construct() {
        
    }

    public function getIdreporta() {
        return $this->idreporta;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getIdanswer() {
        return $this->idanswer;
    }

    public function getReporttext() {
        return $this->reporttext;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdreporta($idreporta) {
        $this->idreporta = $idreporta;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function setIdanswer($idanswer) {
        $this->idanswer = $idanswer;
    }

    public function setReporttext($reporttext) {
        $this->reporttext = $reporttext;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getAll() {
        $data = array();
        $data["idreporta"] = $this->idreporta;
        $data["nickname"] = $this->nickname;
        $data["idanswer"] = $this->idanswer;
        $data["reporttext"] = $this->reporttext;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($idreporta, $nickname, $idanswer, $reporttext, $date) {
        $this->setIdreporta($idreporta);
        $this->setReporttext($nickname);
        $this->setIdanswer($idanswer);
        $this->setReporttext($reporttext);
        $this->setDate($date);
    }

    /* public function toString() {
      $toString = "Review[idreporta=" . $this->idreporta . "][nickname=" . $this->nickname . "][desciption=" . $this->nick . "]";
      return $toString;
      } */
}

?>
