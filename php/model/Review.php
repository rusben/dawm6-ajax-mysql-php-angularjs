 <?php
/** directorClass.php
 * Entity directorClass
 * autor  Roberto Plana
 * version 2012/09
 */
require_once "EntityInterface.php";

class Review implements EntityInterface {
    private $id;
    private $idFilm;
    private $dateReview;
    private $rate;
    private $description;


    function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getIdFilm() {
        return $this->idFilm;
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

    public function setIdFilm($idFilm) {
        $this->idFilm = $idFilm;
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
		$data["idFilm"] = $this->idFilm;
		$data["dateReview"] = $this->dateReview;
		$data["rate"] = $this->rate;
		$data["description"] = $this->description;
		return $data;
    }

    public function setAll($id, $idFilm, $dateReview, $rate, $description) {
		$this->setId($id);
		$this->setIdFilm($idFilm);
		$this->setDateReview($dateReview);
		$this->setRate($rate);
		$this->setDescription($description);
    }

    public function toString() {
        $toString = "Review[id=" . $this->id . "][idFilm=" . $this->idFilm . "][dateReview=" . $this->dateReview . "][rate=" . $this->rate . "][desciption=" . $this->description . "]";
		return $toString;

    }
}
?>
