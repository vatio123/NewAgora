<?php
/**
* ApplyController class
* it controls apply's model server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/Apply.php";
require_once "../model/persist/ApplyADO.php";


class ApplyControllerClass implements ControllerInterface {
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
			case 10010:
				$outPutData = $this->insertApply();
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


	private function insertApply () {
			$ApplyObj = json_decode(stripslashes($this->getJsonData()));
			$outPutData = array();
			$outPutData[]= true;
			$applyId=[];
			$portfolio="without";
			/*he pensado seriamente en hacer una tabla de hobbies, pero es muy poco serio...así que los meto en string,
			es más complicado pero me parece más lógico, para qué vamos a darle un id y una description al hobby¿? XD*/
			$hobbies=$ApplyObj->hobbies;
				$hobby="";
				for($i=0; $i<count($hobbies); $i++){
					$hobby.="-".$hobbies[$i];
				}
				$hobby.="-";
				//error_log("hello");
				//error_log(print_r($apply->getRelocate(),true));
				if($ApplyObj->relocate=='YES') $relocate=true;
				else if($ApplyObj->relocate=='NO') $relocate=false;
			if(isset($ApplyObj->portfolio))$portfolio=$ApplyObj->portfolio;

			$apply = new Apply();//$id, $idVacant, $startDate, $portfolio, $salary, $about, $relocate, $idUser, $hobbies
			$apply->setAll(0, $ApplyObj->idVacant, $ApplyObj->startDate, $portfolio, $ApplyObj->salary, $ApplyObj->about, $relocate, $ApplyObj->idUser, $hobby);
			$applyId =ApplyADO::create($apply);

			$outPutData[] = $applyId;
			return $outPutData;

		}

}
?>
