<?php

/**
 * ValorationaController class
 * it controls valorationa's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Valorationa.class.php";
require_once "../model/persist/ValorationaADO.php";

class ValorationaControllerClass implements ControllerInterface {

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
                error_log("Action not correct in ValorationaControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function llistAll() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listValorationas = ValorationaADO::findAll();
        if (count($listValorationas) == 0) {
            $outPutData[0] = false;
            $errors[] = "No valorationas found in database";
        } else {
            $valorationasArray = array();

            foreach ($listValorationas as $valorationa) {
                $valorationasArray[] = $valorationa->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $valorationasArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }

    private function create() {
        $valorationaObj = json_decode(stripslashes($this->getJsonData()));
        $valorationa = new Valorationa();
        $valorationa->setAll(0, $valorationaObj->nickname, $valorationaObj->idanswer, $valorationaObj->valoration, $valorationaObj->date);
        $outPutData = array();
        $outPutData[] = true;
        $valorationa->setValorationaId(ValorationaADO::create($valorationa));
        //the senetnce returns de nickname of the valorationa inserted
        $outPutData[] = array($valorationa->getAll());
        return $outPutData;
    }



    private function update() {
        //Films modification
        $valorationasArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($valorationasArray as $valorationaObj) {
            $valorationa = new Valorationa();
            $valorationa->setAll($valorationaObj->idvalorationa, $valorationaObj->nickname, $valorationaObj->idanswer, $valorationaObj->valoration, $valorationaObj->date);
            ValorationaADO::update($valorationa);
        }
        return $outPutData;
    }

    private function delete() {
        //Films modification
        $valorationasArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($valorationasArray as $valorationaObj) {
            $valorationa = new Valorationa();
            $valorationa->setAll($valorationaObj->idvalorationa, $valorationaObj->nickname, $valorationaObj->idanswer, $valorationaObj->valoration, $valorationaObj->date);
            ValorationaADO::delete($valorationa);
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $valorationasArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($valorationasArray as $valorationaObj) {
            $valorationa = new Valorationa();
            $valorationa->setAll($valorationaObj->idvalorationa, $valorationaObj->nickname, $valorationaObj->idanswer, $valorationaObj->valoration, $valorationaObj->date);
            ValorationaADO::findByPK($valorationa);
        }
        return $outPutData;
    }


}

?>
