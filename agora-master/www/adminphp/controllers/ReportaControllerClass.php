<?php

/**
 * ReportaController class
 * it controls reporta's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Reporta.class.php";
require_once "../model/persist/ReportaADO.php";

class ReportaControllerClass implements ControllerInterface {

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
                $outPutData = $this->findByAnswerId();
                break;
            default:
                $errors = array();
                $outPutData[0] = false;
                $errors[] = "Sorry, there has been an error. Try later";
                $outPutData[] = $errors;
                error_log("Action not correct in ReportaControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function llistAll() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listReportas = ReportaADO::findAll();
        if (count($listReportas) == 0) {
            $outPutData[0] = false;
            $errors[] = "No reportas found in database";
        } else {
            $reportasArray = array();

            foreach ($listReportas as $reporta) {
                $reportasArray[] = $reporta->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $reportasArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }
/*private $idreporta;
    private $nickname;
    private $idanswer;
    private $reporttext;
    private $date;*/
    private function create() {
        $reportaObj = json_decode(stripslashes($this->getJsonData()));
        $reporta = new Reporta();
        $reporta->setAll(0, $reportaObj->nickname, $reportaObj->idanswer, $reportaObj->reporttext, $reportaObj->date);
        $outPutData = array();
        $outPutData[] = true;
        $reporta->setReportaId(ReportaADO::create($reporta));
        //the senetnce returns de nickname of the reporta inserted
        $outPutData[] = array($reporta->getAll());
        return $outPutData;
    }



    private function update() {
        //Films modification
        $reportasArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($reportasArray as $reportaObj) {
            $reporta = new Reporta();
            $reporta->setAll($reportaObj->idreporta, $reportaObj->nickname, $reportaObj->idanswer, $reportaObj->reporttext, $reportaObj->date);
            ReportaADO::update($reporta);
        }
        return $outPutData;
    }

    private function delete() {
        //Films modification
        $reportasArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($reportasArray as $reportaObj) {
            $reporta = new Reporta();
            $reporta->setAll($reportaObj->idreporta, $reportaObj->nickname, $reportaObj->idanswer, $reportaObj->reporttext, $reportaObj->date);
            ReportaADO::delete($reporta);
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $reportasArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($reportasArray as $reportaObj) {
            $reporta = new Reporta();
            $reporta->setAll($reportaObj->idreporta, $reportaObj->nickname, $reportaObj->idanswer, $reportaObj->reporttext, $reportaObj->date);
            ReportaADO::findByPK($reporta);
        }
        return $outPutData;
    }

    private function findByAnswerId() {
        $reportaObj = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $reporta = new Reporta();
        $reporta->setAll(0, null, $reportaObj->idanswer, null, date("Y-m-d"));
        $listReportas = ReportaADO::findByAnswerId($reporta);
        if (count($listReportas) == 0) {
            $outPutData[0] = false;
            $errors[] = "No reportas found in database";
        } else {
            $reportasArray = array();

            foreach ($listReportas as $reporta) {
                $reportasArray[] = $reporta->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $reportasArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }

}

?>
