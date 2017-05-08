<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class Reportq implements EntityInterface {

    private $idreport;
    private $nickname;
    private $idquestion;
    private $reporttext;
    private $date;

    //----------Data base Values---------------------------------------
    private static $tableName = "repotq";
    private static $colNameIdreport = "idreport";
    private static $colNameNickname = "nickname";
    private static $colNameIdquestion = "idquestion";
    private static $colNameReporttext = "reporttext";
    private static $colNameDate = "date";
    
    public function __construct() {
        
    }

    public function getIdreport() {
        return $this->idreport;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getIdquestion() {
        return $this->idquestion;
    }

    public function getReporttext() {
        return $this->reporttext;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdreport($idreport) {
        $this->idreport = $idreport;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function setIdquestion($idquestion) {
        $this->idquestion = $idquestion;
    }

    public function setReporttext($reporttext) {
        $this->reporttext = $reporttext;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getAll() {
        $data = array();
        $data["idreport"] = $this->idreport;
        $data["nickname"] = $this->nickname;
        $data["idquestion"] = $this->idquestion;
        $data["reporttext"] = $this->reporttext;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($idreport, $nickname, $idquestion, $reporttext, $date) {
        $this->setIdreport($idreport);
        $this->setReporttext($nickname);
        $this->setIdquestion($idquestion);
        $this->setReporttext($reporttext);
        $this->setDate($date);
    }

    /* public function toString() {
      $toString = "Review[idreport=" . $this->idreport . "][nickname=" . $this->nickname . "][desciption=" . $this->nick . "]";
      return $toString;
      } */
}

?>
