<?php

/** UserClass.php
 * Entity UserClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class Topic implements EntityInterface {
    private $topicname;
    private $maintopic;

    //----------Data base Values---------------------------------------
    private static $tableName = "topics";
    private static $colNameTopicname = "topicname";
    private static $colNameMaintopic = "maintopic";
  

    function __construct() {
        
    }

    public function getTopicname() {
        return $this->topicname;
    }

    public function getMaintopic() {
        return $this->maintopic;
    }

    public function setTopicname($topicname) {
        $this->topicname = $topicname;
    }

    public function setMaintopic($maintopic) {
        $this->maintopic = $maintopic;
    }

    

    public function getAll() {
        $data = array();
        $data["topicname"] = $this->topicname;
        $data["maintopic"] = $this->maintopic;
        return $data;
    }

    public function setAll($topicname, $maintopic) {
        $this->setTopicname($topicname);
        $this->setMaintopic($maintopic);
 
    }

    /* public function toString() {
      $toString = "User[topicname=" . $this->topicname . "][maintopic=" . $this->getMaintopic() . "][firstname=" . $this->getFirstname() . "][email=" . $this->email . "][email=" . $this->mail . "]";
      return $toString;
      } */
}

?>
