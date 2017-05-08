<?php

/**
 * UserController class
 * it controls the user's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/User.class.php";
require_once "../model/persist/UserADO.php";

class UserControllerClass implements ControllerInterface {
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
                $outPutData = $this->userConnection();
                break;
            case 10010:
                $outPutData = $this->create();
                break;
            case 10020:
                $outPutData = $this->update();
                break;
            case 10030:
                $outPutData = $this->sessionControl();
                break;
            case 10040:
                //Closing session
                session_unset();
                session_destroy();
                $outPutData[0] = true;
                break;
            case 10050:
                $outPutData = $this->delete();
                break;
            case 10060:
                $outPutData = $this->llistAll();
                break;
            case 10070:
                $outPutData = $this->findByPK();
                break;
            case 10080:
                $outPutData = $this->llistAll();
                break;
            default:
                $errors = array();
                $outPutData[0] = false;
                $errors[] = "Sorry, there has been an error. Try later";
                $outPutData[] = $errors;
                error_log("Action not correct in UserControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $usersArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($usersArray as $userObj) {
            $user = new User();
            $user->setAll($userObj->nickname, $userObj->userscore, $userObj->firstname, $userObj->lastname, $userObj->email, $userObj->password, $userObj->postalcode);
            UserADO::findByNickname($user);
        }
        return $outPutData;
    }

    private function findByEmail() {
        //Films modification
        $usersArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($usersArray as $userObj) {
            $user = new User();
            $user->setAll($userObj->nickname, $userObj->userscore, $userObj->firstname, $userObj->lastname, $userObj->email, $userObj->password, $userObj->postalcode);
            UserADO::findByEmail($user);
        }
        return $outPutData;
    }


    private function create() {
        $userObj = json_decode(stripslashes($this->getJsonData()));
        $user = new User();
        $user->setAll($userObj->nickname, $userObj->userscore, $userObj->firstname, $userObj->lastname, $userObj->email, $userObj->password, $userObj->postalcode);
        $outPutData = array();
        $outPutData[] = true;
        $user->setNickname(UserADO::create($user));
        //the senetnce returns de nickname of the user inserted
        $outPutData[] = array($user->getAll());
        return $outPutData;
    }

    private function update() {
        //Films modification
        $usersArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($usersArray as $userObj) {
            $user = new User();
            $user->setAll($userObj->nickname, $userObj->userscore, $userObj->firstname, $userObj->lastname, $userObj->email, $userObj->password, $userObj->postalcode);
            UserADO::update($user);
        }
        return $outPutData;
    }

    private function delete() {
        //Films modification
        $usersArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($usersArray as $userObj) {
            $user = new User();
            $user->setAll($userObj->nickname, $userObj->userscore, $userObj->firstname, $userObj->lastname, $userObj->email, $userObj->password, $userObj->postalcode);
            UserADO::delete($user);
        }
        return $outPutData;
    }

    private function userConnection() {
        // $outPutData[0] --> response status
        // $outPutData[1] --> data
        $userObj = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $errors = array();
        $outPutData[0] = true;
        $user = new User();
        $user->setNickname($userObj->nickname);
        $user->setPassword($userObj->password);
        $userList = UserADO::findByNickAndPass($user);
        if (count($userList) == 0) {
            $outPutData[0] = false;
            $errors[] = "No user has found with these data";
            $outPutData[1] = $errors;
        } else {
            $usersArray = array();
            foreach ($userList as $user) {
                $usersArray[] = $user->getAll();
            }
            $_SESSION['connectedUser'] = $userList[0];
            $outPutData[1] = $usersArray;
        }
        return $outPutData;
    }

    private function sessionControl() {
        $outPutData = array();
        $outPutData[] = true;
        if (isset($_SESSION['connectedUser'])) {
            $outPutData[] = $_SESSION['connectedUser']->getAll();
        } else {
            $outPutData[0] = false;
            $errors[] = "No session opened";
            $outPutData[1] = $errors;
        }
        return $outPutData;
    }

}

?>
