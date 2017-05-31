 <?php
/** reviewADOClass.php
 * Entity reviewADOClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDvideoclub.php";
require_once "../model/Review.php";

class ReviewADO implements EntityInterface {


    //----------Data base Values---------------------------------------
    private static $tableDateReview = "review";
    private static $colDateReviewId = "id";
    private static $colDateReviewIdUser = "idUser";
    private static $colDateReviewDateReview = "dateReview";
    private static $colDateReviewRate = "rate";
    private static $colDateReviewDescription = "description";

    //---Databese management section-----------------------
    /**
	 * fromResultSetList()
	 * this function runs a query and returns an array with all the result transformed into an object
	 * @param res query to execute
	 * @return objects collection
    */
    private static function fromResultSetList( $res ) {
		$entityList = array();
		$i=0;
		foreach ( $res as $row) {
			//We get all the values an add into the array
			$entity = ReviewADO::fromResultSet( $row );

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
    private static function fromResultSet( $res ) {
	//We get all the values form the query
		$id = $res[ ReviewADO::$colDateReviewId];
		$idUser = $res[ ReviewADO::$colDateReviewIdUser ];
		$dateReview = $res[ ReviewADO::$colDateReviewDateReview ];
		$rate = $res[ ReviewADO::$colDateReviewRate ];
		$description = $res[ ReviewADO::$colDateReviewDescription ];

       	//Object construction
       	$entity = new Review();
		$entity->setId($id);
		$entity->setIdUser($idUser);
		$entity->setDateReview($dateReview);
		$entity->setRate($rate);
		$entity->setDescription($description);

		return $entity;
    }

    /**
	 * findByQuery()
	 * It runs a particular query and returns the result
	 * @param cons query to run
	 * @return objects collection
    */
    public static function findByQuery( $cons, $vector ) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			echo "Error executing query.";
			error_log("Error executing query in ReviewADO: " . $e->getMessage() . " ");
			die();
		}

		//Run the query
		$res = $conn->execution($cons, $vector);

		return ReviewADO::fromResultSetList( $res );
    }

    /**
	 * findById()
	 * It runs a query and returns an object array
	 * @param id
	 * @return object with the query results
    */
    public static function findById( $review ) {
		$cons = "select * from `".ReviewADO::$tableDateReview."` where ".ReviewADO::$colDateReviewId." = ?";
		$arrayValues = [$review->getId()];

		return ReviewADO::findByQuery($cons,$arrayValues);
    }


    /**
	* findByIdClient()
	 * It runs a query and returns an object array
	 * @param dateReview
	 * @return object with the query results
    */
    public static function findByIdClient( $review ) {
		$cons = "select * from `".ReviewADO::$tableDateReview."` where ".ReviewADO::$colDateReviewIdClient." = ?";
		$arrayValues = [$review->getIdClient()];

		return ReviewADO::findByQuery( $cons, $arrayValues );
    }

    /**
	* findByIdUser()
	 * It runs a query and returns an object array
	 * @param dateReview
	 * @return object with the query results
    */
    public static function findByIdUser( $review ) {
		$cons = "select * from `".ReviewADO::$tableDateReview."` where ".ReviewADO::$colDateReviewIdUser." = ?";
		$arrayValues = [$review->getIdUser()];

		return ReviewADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findAll()
	 * It runs a query and returns an object array
	 * @param none
	 * @return object with the query results
    */
    public static function findAll( ) {
    	$cons = "select * from `".ReviewADO::$tableDateReview."`";
    	$arrayValues = [];

		return ReviewADO::findByQuery( $cons, $arrayValues );
    }


    /**
	 * create()
	 * insert a new row into the database
    */
    public function create($review) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="insert into ".ReviewADO::$tableDateReview." (`idUser`,`dateReview`,`rate`,`description`) values (?, ?, ?, ?)";
		$arrayValues= [$review->getIdUser(),$review->getDateReview(),$review->getRate(),$review->getDescription()];

		$id = $conn->executionInsert($cons, $arrayValues);

		$review->setId($id);

	    return $review->getId();
	}

    /**
	 * delete()
	 * it deletes a row from the database
    */
    public function delete($review) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}


		$cons="delete from `".ReviewADO::$tableDateReview."` where ".ReviewADO::$colDateReviewId." = ?";
		$arrayValues= [$review->getId()];

		$conn->execution($cons, $arrayValues);
    }


    /**
	 * update()
	 * it updates a row of the database
    */
    public function update($review) {
		//Connection with the database
		try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="update `".ReviewADO::$tableDateReview."` set ".ReviewADO::$colDateReviewIdUser." = ?,".ReviewADO::$colDateReviewDateReview." = ?,".
				   ReviewADO::$colDateReviewRate." = ?, ".ReviewADO::$colDateReviewDescription." =? where ".ReviewADO::$colDateReviewId." = ?";
		$arrayValues= [$review->getIdUser(),$review->getDateReview(),$review->getRate(),$review->getDescription(), $review->getId()];

		$conn->execution($cons, $arrayValues);
    }

    public function toString() {
        $toString .= "ReviewADO[id=" . $this->id . "][idUser=" . $this->idUser . "][dateReview=" . $this->dateReview . "][rate=" . $this->rate . "][desciption=" . $this->desciption . "]";
		return $toString;

    }
}
?>
