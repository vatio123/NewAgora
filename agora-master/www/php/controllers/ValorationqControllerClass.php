<?php

/**
 * ValorationqController class
 * it controls valorationq's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Valorationq.class.php";
require_once "../model/persist/ValorationqADO.php";
require_once "../model/User.class.php";
require_once "../model/persist/UserADO.php";
require_once "../model/Question.class.php";
require_once "../model/persist/QuestionADO.php";

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
        $valorationq->setAll(0, $valorationqObj->nickname, $valorationqObj->idquestion, $valorationqObj->valoration, date("Y-m-d"));
        //
        $question = new Question();
        $question->setAll($valorationqObj->idquestion, null, null, null, null);
        $question2 = QuestionADO::findByIdQuestion($question);
        
        //
        
        $user = new User();
        $user->setUser($question2[0]->getNickname(), 0, null, null, null, null, 0);
  
        $user2 = new User();
        $userObj = UserADO::findByNickname($user);
        $user2->setUser($userObj[0]->getNickname(), $userObj[0]->getUserscore(), $userObj[0]->getFirstname(), $userObj[0]->getLastname(), $userObj[0]->getEmail(), $userObj[0]->getPassword(), $userObj[0]->getPostalcode());
        //$user2->setUser($user2->nickname, $user2->userscore + $valorationaObj->valoration, $user2->firstname, $user2->lastname, $user2->email, $user2->password, $user2->postalcode);
        $user2->setUser($user2->getNickname(), $user2->getUserscore() + $valorationqObj->valoration, $user2->getFirstname(), $user2->getLastname(), $user2->getEmail(), $user2->getPassword(), $user2->getPostalcode());
        UserADO::update2($user2);
        
        //
        $outPutData = array();
        $outPutData[] = true;
        $valorationq->setIdvalorationq(ValorationqADO::create($valorationq));
        //the senetnce returns de nickname of the valorationq inserted
        $outPutData[] = array($valorationq->getAll());
        return $outPutData;
    }

    /*private function create() {
        $valorationaObj = json_decode(stripslashes($this->getJsonData()));
        $valorationa = new Valorationa();
        $valorationa->setAll(0, $valorationaObj->nickname, $valorationaObj->idanswer, $valorationaObj->valoration, $valorationaObj->date);
        //
        $user = new User();
        $user->setUser($valorationaObj->nickname, 0, null, null, null, null, 0);
  
        $user2 = new User();
        $userObj = UserADO::findByNickname($user);
        $user2->setUser($userObj[0]->getNickname(), $userObj[0]->getUserscore() + $valorationaObj->valoration, $userObj[0]->getFirstname(), $userObj[0]->getLastname(), $userObj[0]->getEmail(), $userObj[0]->getPassword(), $userObj[0]->getPostalcode());
        //$user2->setUser($user2->nickname, $user2->userscore + $valorationaObj->valoration, $user2->firstname, $user2->lastname, $user2->email, $user2->password, $user2->postalcode);
        $user2->setUser($user2->getNickname(), $user2->getUserscore() + $valorationaObj->valoration, $user2->getFirstname(), $user2->getLastname(), $user2->getEmail(), $user2->getPassword(), $user2->getPostalcode());
        UserADO::update2($user2);
        //take score + x
        //
        $outPutData = array();
        $outPutData[] = true;
        $valorationa->setIdvalorationa(ValorationaADO::create($valorationa));
        //the senetnce returns de nickname of the valorationa inserted
        $outPutData[] = array($valorationa->getAll());
        return $outPutData;
    }*/


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
