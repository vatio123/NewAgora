 <?php
 /** reviewClass.php
  * Entity reviewClass
  * author  norosa@programmer.net
  * version 2017/04
  */
require_once "EntityInterface.php";

class Review implements EntityInterface {
    private $id;
    private $idUser;
    private $dateReview;
    private $rate;
    private $description;


    function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getDateReview() {
        return $this->dateReview;
    }


    public function getRate() {
        return $this->rate;
    }

    public function getDescription() {
        return $this->description;
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setDateReview($dateReview) {
        $this->dateReview = $dateReview;
    }


    public function setRate($rate) {
        $this->rate = $rate;
    }

    public function setDescription($description) {
        $this->description = $description;
    }


    public function getAll() {
		$data = array();
		$data["id"] = $this->id;
		$data["idUser"] = $this->idUser;
		$data["dateReview"] = $this->dateReview;
		$data["rate"] = $this->rate;
		$data["description"] = $this->description;
		return $data;
    }

    public function setAll($id, $idUser, $dateReview, $rate, $description) {
		$this->setId($id);
		$this->setIdUser($idUser);
		$this->setDateReview($dateReview);
		$this->setRate($rate);
		$this->setDescription($description);
    }

    public function toString() {
        $toString = "Review[id=" . $this->id . "][idUser=" . $this->idUser . "][dateReview=" . $this->dateReview . "][rate=" . $this->rate . "][desciption=" . $this->description . "]";
		return $toString;

    }
}
?>
