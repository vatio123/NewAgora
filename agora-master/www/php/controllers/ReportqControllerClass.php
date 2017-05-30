<?php

/**
 * ReportqController class
 * it controls reportq's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Reportq.class.php";
require_once "../model/persist/ReportqADO.php";

class ReportqControllerClass implements ControllerInterface {

    private $action;
    private $jsonData;

    function __construct($action, $jsonData) {
        $this->setAction($action);
        $this->setJsonData($jsonData);
    }

    public function getAction() {
        return $this->action;
    }

    public function getJsonData() {
        return $this->jsonData;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setJsonData($jsonData) {
        $this->jsonData = $jsonData;
    }

    public function doAction() {
        $outPutData = array();

        switch ($this->getAction()) {
            case 10010:
                $outPutData = $this->llistAll();
                break;
            case 10020:
                $outPutData = $this->create();
                break;
            case 10030:
                $outPutData = $this->delete();
                break;
            case 10040:
                $outPutData = $this->update();
                break;
            case 10050:
                $outPutData = $this->findByPK();
                break;
            case 10060:
                $outPutData = $this->findByQuestionId();
                break;
            default:
                $errors = array();
                $outPutData[0] = false;
                $errors[] = "Sorry, there has been an error. Try later";
                $outPutData[] = $errors;
                error_log("Action not correct in ReportqControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function llistAll() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listReportqs = ReportqADO::findAll();
        if (count($listReportqs) == 0) {
            $outPutData[0] = false;
            $errors[] = "No reportqs found in database";
        } else {
            $reportqsArray = array();

            foreach ($listReportqs as $reportq) {
                $reportqsArray[] = $reportq->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $reportqsArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }
/*private $idreport;
    private $nickname;
    private $idquestion;
    private $reporttext;
    private $date;*/
    private function create() {
        $reportqObj = json_decode(stripslashes($this->getJsonData()));
        $reportq = new Reportq();
        $reportq->setAll(0, $reportqObj->nickname, $reportqObj->idquestion, $reportqObj->reporttext, $reportqObj->date);
        $outPutData = array();
        $outPutData[] = true;
        $reportq->setReportqId(ReportqADO::create($reportq));
        //the senetnce returns de nickname of the reportq inserted
        $outPutData[] = array($reportq->getAll());
        return $outPutData;
    }



    private function update() {
        //Films modification
        $reportqsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($reportqsArray as $reportqObj) {
            $reportq = new Reportq();
            $reportq->setAll($reportqObj->idreport, $reportqObj->nickname, $reportqObj->idquestion, $reportqObj->reporttext, $reportqObj->date);
            ReportqADO::update($reportq);
        }
        return $outPutData;
    }

    private function delete() {
        //Films modification
        $reportqsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($reportqsArray as $reportqObj) {
            $reportq = new Reportq();
            $reportq->setAll($reportqObj->idreport, $reportqObj->nickname, $reportqObj->idquestion, $reportqObj->reporttext, $reportqObj->date);
            ReportqADO::delete($reportq);
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $reportqsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($reportqsArray as $reportqObj) {
            $reportq = new Reportq();
            $reportq->setAll($reportqObj->idreport, $reportqObj->nickname, $reportqObj->idquestion, $reportqObj->reporttext, $reportqObj->date);
            ReportqADO::findByPK($reportq);
        }
        return $outPutData;
    }

        private function findByQuestionId() {
        $reportqObj = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $reportq = new Reportq();
        $reportq->setAll(0, null, $reportqObj->idquestion, null, date("Y-m-d"));
        $listReportqs = ReportqADO::findByQuestionId($reportq);
        if (count($listReportqs) == 0) {
            $outPutData[0] = false;
            $errors[] = "No reportqs found in database";
        } else {
            $reportqsArray = array();

            foreach ($listReportqs as $reportq) {
                $reportqsArray[] = $reportq->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $reportqsArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }
    

    
}

?>
