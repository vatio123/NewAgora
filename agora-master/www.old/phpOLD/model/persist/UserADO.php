<?php

/** UserADOClass.php
 * Entity UserADOClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "BDagora.php";
require_once "EntityInterfaceADO.php";
require_once "../model/User.class.php";

class UserADO implements EntityInterfaceADO {

    //----------Data base Values---------------------------------------
    private static $tableName = "users";
    private static $colNameNickname = "nickname";
    private static $colNameUserscore = "userscore";
    private static $colNameFirstname = "firstname";
    private static $colNameLastname = "lastname";
    private static $colNameEmail = "email";
    private static $colNamePassword = "password";
    private static $colNamePostalcode = "postalcode";


    //---Databese management section-----------------------
    /**
     * fromResultSetList()
     * this function runs a query and returns an array with all the result transformed into an object
     * @param res query to execute
     * @return objects collection
     */
    public static function fromResultSetList($res) {
        $entityList = array();
        $i = 0;
        //while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
        foreach ($res as $row) {
            //We get all the values an add into the array
            $entity = UserADO::fromResultSet($row);
            $entityList[$i] = $entity;
            $i++;
        }
        return $entityList;
    }

    /**
     * fromResultSet()
     * the query result is transformed into an object
     * @param res ResultSet del qual obtenir dades
     * @return object
     */
    public static function fromResultSet($res) {
        //We get all the values form the query
        $nickname = $res[UserADO::$colNameNickname];
        $userscore = $res[UserADO::$colNameUserscore];
        $firstname = $res[UserADO::$colNameFirstname];
        $lastname = $res[UserADO::$colNameLastname];
        $email = $res[UserADO::$colNameEmail];
        $password = $res[UserADO::$colNamePassword];
        $postalcode = $res[UserADO::$colNamePostalcode];

        //Object construction
        $entity = new User();
        $entity->setNickname($nickname);
        $entity->setUserscore($userscore);
        $entity->setFirstname($firstname);
        $entity->setLastname($lastname);
        $entity->setEmail($email);
        $entity->setPassword($password);
        $entity->setPostalcode($postalcode);
        return $entity;
    }

    /**
     * findByQuery()
     * It runs a particular query and returns the result
     * @param cons query to run
     * @return objects collection
     */
    public static function findByQuery($cons, $vector) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            echo "Error executing query.";
            error_log("Error executing query in UserADO: " . $e->getMessage() . " ");
            die();
        }
        $res = $conn->execution($cons, $vector);
        return UserADO::fromResultSetList($res);
    }

    /**
     * findByNickname()
     * It runs a query and returns an object array
     * @param nickname
     * @return object with the query results
     */
    public static function findByNickname($user) {
        $cons = "select * from `" . UserADO::$tableName . "` where " . UserADO::$colNameNickname . " = ?";
        $arrayValues = [$user->getNickname()];
        return UserADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByEmail()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByEmail($user) {
        $cons = "select * from `" . UserADO::$tableName . "` where " . UserADO::$colNameEmail . " = ?";
        $arrayValues = [$user->getEmail()];
        return UserADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByNick()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByLastname($user) {
        $cons = "select * from `" . UserADO::$tableName . "` where " . UserADO::$colNameLastname . " = ?";
        $arrayValues = [$user->getLastname()];
        return UserADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByNickAndPass()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByNickAndPass($user) {
        //$cons = "select * from `".UserADO::$tableName."` where ".UserADO::$colNameNick." = \"".$user->getNick()."\" and ".UserADO::$colNameEmail." = \"".$user->getEmail()."\"";
        $cons = "select * from `" . UserADO::$tableName . "` where " . UserADO::$colNameNick . " = ? and " . UserADO::$colNameEmail . " = ?";
        $arrayValues = [$user->getNick(), $user->getEmail()];
        return UserADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findAll()
     * It runs a query and returns an object array
     * @param none
     * @return object with the query results
     */
    public static function findAll() {
        $cons = "select * from `" . UserADO::$tableName . "`";
        $arrayValues = [];
        return UserADO::findByQuery($cons, $arrayValues);
    }

    /**
     * create()
     * insert a new row into the database
     */
    public function create($user) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "insert into " . UserADO::$tableName . " (`nickname`,`userscore`,`firstname`,`lastname`,`email`,`password`,`postalcode`) values (?, ?, ?, ?, ?, ?, ?)";
        $arrayValues = [$user->getNickname(), $user->getUserscore(), $user->getFirstname(), $user->getLastname(), $user->getEmail(), sha1($user->getPassword()), $user->getPostalcode()];
        $nickname = $conn->executionInsert($cons, $arrayValues);
        $user->setNickname($nickname);
        return $user->getNickname();
    }

    /**
     * delete()
     * it deletes a row from the database
     */
    public function delete($user) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "delete from `" . UserADO::$tableName . "` where " . UserADO::$colNameNickname . " = ?";
        $arrayValues = [$user->getNickname()];
        $conn->execution($cons, $arrayValues);
    }

    /**
     * update()
     * it updates a row of the database
     */
    public function update($user) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "update `" . UserADO::$tableName . "` set " . UserADO::$colNameUserscore . " = ?, " . UserADO::$colNameFirstname . " = ?, " . UserADO::$colNameLastname . " = ?, " . UserADO::$colNameEmail . " = ?, " . UserADO::$colNamePassword . " = ?, " . UserADO::$colNamePostalcode . " = ?, " ;
        $arrayValues = [$user->getUserscore(), $user->getFirstname(), $user->getLastname(), $user->getEmail(), $user->getPassword(), $user->getPostalcode()];
        $conn->execution($cons, $arrayValues);
    }

}

?>
