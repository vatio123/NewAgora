<?php

/**
 * ValorationqController class
 * it controls valorationq's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Valorationq.class.php";
require_once "../model/persist/ValorationqADO.php";

class ValorationqControllerClass implements ControllerInterface {

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
            case 10000:
                $outPutData = $this->llistAll();
                break;
            case 10100:
                $outPutData = $this->create();
                break;
            case 10200:
                $outPutData = $this->delete();
                break;
            case 10300:
                $outPutData = $this->update();
                break;
            case 10400:
                $outPutData = $this->findByPK();
                break;
            default:
                $errors = array();
                $outPutData[0] = false;
                $errors[] = "Sorry, there has been an error. Try later";
                $outPutData[] = $errors;
                error_log("Action not correct in ValorationqControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function llistAll() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listValorationqs = ValorationqADO::findAll();
        if (count($listValorationqs) == 0) {
            $outPutData[0] = false;
            $errors[] = "No valorationqs found in database";
        } else {
            $valorationqsArray = array();

            foreach ($listValorationqs as $valorationq) {
                $valorationqsArray[] = $valorationq->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $valorationqsArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }

    private function create() {
        $valorationqObj = json_decode(stripslashes($this->getJsonData()));
        $valorationq = new Valorationq();
        $valorationq->setAll(0, $valorationqObj->nickname, $valorationqObj->idquestion, $valorationqObj->valoration, $valorationqObj->date);
        $outPutData = array();
        $outPutData[] = true;
        $valorationq->setValorationqId(ValorationqADO::create($valorationq));
        //the senetnce returns de nickname of the valorationq inserted
        $outPutData[] = array($valorationq->getAll());
        return $outPutData;
    }



    private function update() {
        //Films modification
        $valorationqsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($valorationqsArray as $valorationqObj) {
            $valorationq = new Valorationq();
            $valorationq->setAll($valorationqObj->idvalorationq, $valorationqObj->nickname, $valorationqObj->idquestion, $valorationqObj->valoration, $valorationqObj->date);
            ValorationqADO::update($valorationq);
        }
        return $outPutData;
    }

    private function delete() {
        //Films modification
        $valorationqsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($valorationqsArray as $valorationqObj) {
            $valorationq = new Valorationq();
            $valorationq->setAll($valorationqObj->idvalorationq, $valorationqObj->nickname, $valorationqObj->idquestion, $valorationqObj->valoration, $valorationqObj->date);
            ValorationqADO::delete($valorationq);
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $valorationqsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($valorationqsArray as $valorationqObj) {
            $valorationq = new Valorationq();
            $valorationq->setAll($valorationqObj->idvalorationq, $valorationqObj->nickname, $valorationqObj->idquestion, $valorationqObj->valoration, $valorationqObj->date);
            ValorationqADO::findByPK($valorationq);
        }
        return $outPutData;
    }


}

?>
