<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class Reporta implements EntityInterface {

    private $idreport;
    private $nickname;
    private $idanswer;
    private $reporttext;
    private $date;

     //----------Data base Values---------------------------------------
    private static $tableName = "reporta";
    private static $colNameIdreport = "idreport";
    private static $colNameNickname = "nickname";
    private static $colNameIdanswer = "idanswer";
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

    public function getIdanswer() {
        return $this->idanswer;
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
        $data["idreport"] = $this->idreport;
        $data["nickname"] = $this->nickname;
        $data["idanswer"] = $this->idanswer;
        $data["reporttext"] = $this->reporttext;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($idreport, $nickname, $idanswer, $reporttext, $date) {
        $this->setIdreport($idreport);
        $this->setNickname($nickname);
        $this->setIdanswer($idanswer);
        $this->setReporttext($reporttext);
        $this->setDate($date);
    }

    /* public function toString() {
      $toString = "Review[idreport=" . $this->idreport . "][nickname=" . $this->nickname . "][desciption=" . $this->nick . "]";
      return $toString;
      } */
}

?>
