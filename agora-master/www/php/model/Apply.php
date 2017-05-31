<?php
/** ApplyClass.php
 * Entity ApplyClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class Apply implements EntityInterface {
    private $id;
    private $idVacant;
    private $startDate;
    private $portfolio;
    private $salary;
    private $about;
    private $relocate;
    private $idUser;
    private $hobbies;

    function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getIdVacant() {
        return $this->idVacant;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getPortfolio() {
        return $this->portfolio;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function getAbout() {
        return $this->about;
    }

    public function getRelocate() {
        return $this->relocate;
    }

    public function getIdUser() {
        return $this->idUser;
    }

	public function getHobbies() {
        return $this->hobbies;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdVacant($idVacant) {
        $this->idVacant = $idVacant;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function setPortfolio($portfolio) {
        $this->portfolio = $portfolio;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function setAbout($about) {
        $this->about = $about;
    }

    public function setRelocate($relocate) {
        $this->relocate = $relocate;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setHobbies($hobbies) {
        $this->hobbies = $hobbies;
    }

    public function getAll() {
		$data = array();
		$data["id"] = $this->id;
		$data["idVacant"] = $this->idVacant;
		$data["startDate"] = $this->startDate;
		$data["portfolio"] = $this->portfolio;
		$data["salary"] = $this->salary;
		$data["about"] = $this->about;
		$data["relocate"] = $this->relocate;
		$data["idUser"] = $this->idUser;
		$data["hobbies"] = $hobbies;
		//$data["hobbies"] = $this->hobbies;
		return $data;
    }

    public function setAll($id, $idVacant, $startDate, $portfolio, $salary, $about, $relocate, $idUser, $hobbies) {
		$this->setId($id);
		$this->setIdVacant($idVacant);
		$this->setStartDate($startDate);
		$this->setPortfolio($portfolio);
		$this->setSalary($salary);
		$this->setAbout($about);
		$this->setRelocate($relocate);
		$this->setIdUser($idUser);
		$this->setHobbies($hobbies);
    }

    public function toString() {
        $toString = "Hobby[id=" . $this->id . "][idVacant=" . $this->idVacant . "][startDate=" . $this->startDate . "][portfolio=" . $this->portfolio . "][salary=" . $this->salary . "][about=" . $this->about . "][relocate=" . $this->relocate . "][idUser=" . $this->idUser . "]";
		return $toString;
    }
}
?>
