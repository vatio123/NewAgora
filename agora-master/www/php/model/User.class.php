<?php

/** UserClass.php
 * Entity UserClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class User implements EntityInterface {
    private $nickname;
    private $userscore;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $postalcode;
    
    //----------Data base Values---------------------------------------
    private static $tableName = "users";
    private static $colNameNickname = "nickname";
    private static $colNameUserscore = "userscore";
    private static $colNameFirstname = "firstname";
    private static $colNameLastname = "lastname";
    private static $colNameEmail = "email";
    private static $colNamePassword = "password";
    private static $colNamePostalcode = "postalcode";

    function __construct() {
        
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getUserscore() {
        return $this->userscore;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPostalcode() {
        return $this->postalcode;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function setUserscore($userscore) {
        $this->userscore = $userscore;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

    public function getAll() {
        $data = array();
        $data["nickname"] = $this->nickname;
        $data["userscore"] = $this->userscore;
        $data["firstname"] = $this->firstname;
        $data["lastname"] = $this->lastname;
        $data["email"] = $this->email;
        $data["password"] = $this->password;
        $data["postalcode"] = $this->postalcode;
        return $data;
    }

    public function setAll($nickname, $userscore, $firstname, $lastname, $email, $password, $postalcode) {
        $this->setNickname($nickname);
        $this->setUserscore($userscore);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPostalcode($postalcode);
    }

    /* public function toString() {
      $toString = "User[nickname=" . $this->nickname . "][userscore=" . $this->getUserscore() . "][firstname=" . $this->getFirstname() . "][email=" . $this->email . "][email=" . $this->mail . "]";
      return $toString;
      } */
}

?>
