<?php
/**
* ReviewController class
* it controls the review's model server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/Review.php";


class ReviewControllerClass implements ControllerInterface {
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

	public function doAction()
	{
		$outPutData = array();

		switch ( $this->getAction() )
		{
			case 10000:
				$outPutData = $this->loadInitData();
				break;
			/*case 10010:
				$outPutData = $this->insertReview();
				break;*/
			case 10020:
				$outPutData = $this->loadReview();
				break;
			case 10030:
				$outPutData = $this->modReview();
				break;
			case 10040:
				$outPutData = $this->delete();
				break;
			default:
				$errors = array();
				$outPutData[0]=false;
				$errors[]="Sorry, there has been an error. Try later";
				$outPutData[]=$errors;
				error_log("Action not correct in FilmControllerClass, value: ".$this->getAction());
				break;
		}

		return $outPutData;
	}

	private function loadInitData()
	{
		$outPutData = array();
		$outPutData[]=true;
		$errors = array();

		//$listReviewType = FilmTypeADO::findAll();
		$listReviews = ReviewADO::findAll();
		$listUsers = UserADO::findAll();
		//$listDirectors = DirectorADO::findAll();

		if(count($listReviews)==0)
		{
			$outPutData[0]=false;
			$errors[]="No reviews found in database";
		}
		else
		{
			$reviewsArray=array();

			foreach ($listReviews as $review)
			{
				$reviewsArray[]=$review->getAll();
			}
		}
		if(count($listUsers)==0){
			$outputData[0]=false;
			$errors[]="No users found in database";
		}
		else{
			$usersArray=array();

			foreach ($listUsers as $user)
			{
				$usersArray[]=$user->getAll();
			}
		}

		/*if(count($listDirectors)==0)
		{
			$outPutData[0]=false;
			$errors[]="No Directors found in database";
		}
		else
		{
			$directorsArray=array();

			foreach ($listDirectors as $director)
			{
				$directorsArray[]=$director->getAll();
			}
		}*/

		if($outPutData[0])
		{
			/*$outPutData[]=$reviewTypesArray;
			$outPutData[]=$directorsArray;*/
			$outPutData[]=$reviewsArray;
			$outPutData[]=$usersArray;
		}
		else
		{
			$outPutData[]=$errors;
		}

		return $outPutData;
	}


	private function loadReview()
	{
		$outPutData = array();
		$outPutData[]=true;
		$errors = array();

		$listReview = FilmADO::findAll();


		if(count($listReview)==0)
		{
			$outPutData[0]=false;
			$errors[]="No reviews found in database";
		}
		else
		{
			$reviewsArray=array();

			foreach ($listReview as $review)
			{
				$reviewsArray[]=$review->getAll();
			}
		}


		if($outPutData[0])
		{
			$outPutData[]=$reviewsArray;
		}
		else
		{
			$outPutData[]=$errors;
		}

		return $outPutData;
	}

	private function modReview () {
		$reviewsArray = json_decode($this->getJsonData());
		$outPutData = array();
		$outPutData[]= true;
		$reviewIds = array();
		foreach ($reviewsArray as $reviewObj) {
			$review = new Review();
//$id, $idUser, $dateReview, $rate, $description
			$review->setAll($reviewObj->id, $reviewObj->idUser, $reviewObj->dateReview , $reviewObj->rate, $reviewObj->description);

			$reviewIds[] =ReviewADO::update($review);

		}


		$outPutData[] = $reviewIds;
		return $outPutData;
	}

	private function delete(){
		$reviewObj = json_decode($this->getJsonData());
		$outPutData = array();
		$outPutData[]= true;
		$revi = new Review();
//$id, $idUser, $dateReview, $rate, $description
		$revi->setAll($reviewObj->id, $reviewObj->idUser, $reviewObj->dateReview , $reviewObj->rate, $reviewObj->description);
		$conf=ReviewADO::delete($revi);
		$outPutData[]=$conf;
		return $outPutData;
	}


}
?>
