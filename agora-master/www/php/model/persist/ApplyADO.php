<?php
/** applyClass.php
* Entity applyClass
* author  norosa@programmer.net
* version 2017/04
*/
require_once "BDvideoclub.php";
require_once "EntityInterfaceADO.php";
require_once "ReviewADO.php";
require_once "../model/Review.php";

class ApplyADO implements EntityInterfaceADO {

  //----------Data base Values---------------------------------------
  private static $tablePortfolio = "apply";
  private static $colPortfolioId = "id";
  private static $colPortfolioIdVacant = "idVacant";
  private static $colPortfolioStartDate = "startDate";
  private static $colPortfolioPortfolio = "portfolio";
  private static $colPortfolioSalary = "salary";
  private static $colPortfolioAbout = "about";
  private static $colPortfolioRelocate = "relocate";
  private static $colPortfolioIdUser = "idUser";
  private static $colPortfolioHoobies = "hobbies";


  //---Databese management section-----------------------
  /**
  * fromResultSetList()
  * this function runs a query and returns an array with all the result transformed into an object
  * @param res query to execute
  * @return objects collection
  */
  public static function fromResultSetList( $res ) {
    $entityList = array();
    $i=0;
    //while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
    foreach ( $res as $row)
    {
      //We get all the values an add into the array
      $entity = ApplyADO::fromResultSet( $row );

      $entityList[$i]= $entity;
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
  public static function fromResultSet( $res ) {
    //We get all the values form the query
    $id = $res[ ApplyADO::$colPortfolioId];
    $idVacant = $res[ ApplyADO::$colPortfolioIdVacant ];
    $startDate = $res[ ApplyADO::$colPortfolioStartDate ];
    $portfolio = $res[ ApplyADO::$colPortfolioPortfolio ];
    $salary = $res[ ApplyADO::$colPortfolioSalary ];
    $about = $res[ ApplyADO::$colPortfolioAbout ];
    $relocate = $res[ ApplyADO::$colPortfolioRelocate ];
    $idUser = $res[ ApplyADO::$colPortfolioIdUser ];
    $hobbies =$res[ApplyADO:: $colPortfolioHoobies];
    //Object construction
    $entity = new Apply();
    $entity->setId($id);
    $entity->setIdVacant($idVacant);
    $entity->setStartDate($startDate);
    $entity->setPortfolio($portfolio);
    $entity->setSalary($salary);
    $entity->setAbout($about);
    $entity->setRelocate($relocate);
    $entity->setIdUser($idUser);
    $entity->setHobbies($hobbies);
    return $entity;
  }

  /**
  * findByQuery()
  * It runs a particular query and returns the result
  * @param cons query to run
  * @return objects collection
  */
  public static function findByQuery( $cons, $vector ) {
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error executing query.";
      error_log("Error executing query in ApplyADO: " . $e->getMessage() . " ");
      die();
    }

    //Run the query
    $res = $conn->execution($cons, $vector);

    return ApplyADO::fromResultSetList( $res );
  }

  /**
  * findById()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findById( $apply ) {
    $cons = "select * from `".ApplyADO::$tablePortfolio."` where ".ApplyADO::$colPortfolioId." = ?";
    $arrayValues = [$apply->getId()];

    return ApplyADO::findByQuery( $cons, $arrayValues );
  }


  /**
  * findByStartDate()
  * It runs a query and returns an object array
  * @param portfolio
  * @return object with the query results
  */
  public static function findByStartDate( $apply ) {
    $cons = "select * from `".ApplyADO::$tablePortfolio."` where ".ApplyADO::$colPortfolioStartDate." = ?";
    $arrayValues = [$apply->getStartDate()];

    return ApplyADO::findByQuery( $cons, $arrayValues );
  }


  /**
  * findAll()
  * It runs a query and returns an object array
  * @param none
  * @return object with the query results
  */
  public static function findAll() {
    $cons = "select * from `".ApplyADO::$tablePortfolio."`";
    return ApplyADO::findByQuery( $cons, [] );
  }

  /**
  * findLikePortfolio()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikePortfolio( $apply ) {
    $cons = "select * from `".ApplyADO::$tablePortfolio."` where ".ApplyADO::$colPortfolioPortfolio." like \"%".$apply->getPortfolio()."%\"";
    $arrayValues = [];

    return ApplyADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * findLikePortfolioAndStartDate()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikePortfolioAndStartDate( $apply ) {
    $cons = "select * from `".ApplyADO::$tablePortfolio."` where ".ApplyADO::$colPortfolioPortfolio." like ? and ".ApplyADO::$colPortfolioStartDate." = ?";
    $arrayValues = ["%".$apply->getStartDate()."%",$apply->getStartDate()];

    return ApplyADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * findLikeSalary()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikeSalary( $apply ) {
    $cons = "select * from `".ApplyADO::$tablePortfolio."` where ".ApplyADO::$colPortfolioSalary." like ?";
    $arrayValues = ["%".$apply->getSalary()."%"];

    return ApplyADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * create()
  * insert a new row into the database
  */
  public function create($apply) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in create in ApplyADO: " . $e->getMessage() . " ");
      die();
    }
    //json_decode($this->getJsonData());
    $cons="insert into ".ApplyADO::$tablePortfolio." (`idVacant`,`startDate`,`portfolio`,`salary`, `hobbies`, `about`,`relocate`,`idUser`) values (?, ?, ?, ?, ?, ?, ?, ?)" ;
    $arrayValues= [$apply->getIdVacant(),date('Y-m-d', strtotime($apply->getStartDate())), $apply->getPortfolio(), $apply->getSalary(), $apply->getHobbies(), $apply->getAbout(), ((int)$apply->getRelocate()), ((int) $apply->getIdUser())];

    $id = $conn->executionInsert($cons, $arrayValues);

    $apply->setId($id);

    return $apply->getId();
  }

  /**
  * delete()
  * it deletes a row from the database
  */
  public function delete($apply) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in delete in ApplyADO: " . $e->getMessage() . " ");
      die();
    }


    $cons="delete from `".ApplyADO::$tablePortfolio."` where ".ApplyADO::$colPortfolioId." = ?";
    $arrayValues= [$apply->getId()];

    $conn->execution($cons, $arrayValues);
  }


  /**
  * update()
  * it updates a row of the database
  */
  public function update($apply) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      print "Error connecting database: " . $e->getMessage() . " ";
      die();
    }

    $cons="update `".ApplyADO::$tablePortfolio."` set ".ApplyADO::$colPortfolioIdVacant." = ?,".ApplyADO::$colPortfolioStartDate." = ?,".ApplyADO::$colPortfolioPortfolio." = ?,".
    ApplyADO::$colPortfolioSalary." = ?, ".ApplyADO::$colPortfolioAbout." = ?, ".ApplyADO::$colPortfolioRelocate." = ?, ".ApplyADO::$colPortfolioIdUser." = ? where ".ApplyADO::$colPortfolioId." = ?";
    $arrayValues= [$apply->getIdVacant(),$apply->getStartDate(), $apply->getPortfolio(), $apply->getSalary(), $apply->getAbout(), ((int) $apply->getRelocate()), ((int) $apply->getIdUser()), $apply->getId()];

    $conn->execution($cons, $arrayValues);

  }
}
?>
