<?php
/** directorClass.php
 * Entity directorClass
 * autor  Roberto Plana
 * version 2012/09
 */
require_once "Review.php";
require_once "EntityInterface.php";

class Film implements EntityInterface {
    private $id;
    private $idFilmType;
    private $idDirector;
    private $name;
    private $price;
    private $image;
    private $inSale;
    private $rented;
    private $reviews = array();

    function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getIdFilmType() {
        return $this->idFilmType;
    }

    public function getIdDirector() {
        return $this->idDirector;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImage() {
        return $this->image;
    }

    public function getInSale() {
        return $this->inSale;
    }

    public function getRented() {
        return $this->rented;
    }

	public function getReviews() {
        return $this->reviews;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdFilmType($idFilmType) {
        $this->idFilmType = $idFilmType;
    }

    public function setIdDirector($idDirector) {
        $this->idDirector = $idDirector;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setInSale($inSale) {
        $this->inSale = $inSale;
    }

    public function setRented($rented) {
        $this->rented = $rented;
    }

    public function setReviews($reviews) {
        $this->reviews = $reviews;
    }

    public function getAll() {
		$data = array();
		$data["id"] = $this->id;
		$data["idFilmType"] = $this->idFilmType;
		$data["idDirector"] = $this->idDirector;
		$data["name"] = $this->name;
		$data["price"] = $this->price;
		$data["image"] = $this->image;
		$data["inSale"] = $this->inSale;
		$data["rented"] = $this->rented;

		$reviewsArray=array();

		foreach ($this->reviews as $review)
		{
			$reviewsArray[]=$review->getAll();
		}
		$data["reviews"] = $reviewsArray;
		//$data["reviews"] = $this->reviews;
		return $data;
    }

    public function setAll($id, $idFilmType, $idDirector, $name, $price, $image, $inSale, $rented, $reviews) {
		$this->setId($id);
		$this->setIdFilmType($idFilmType);
		$this->setIdDirector($idDirector);
		$this->setName($name);
		$this->setPrice($price);
		$this->setImage($image);
		$this->setInSale($inSale);
		$this->setRented($rented);
		$this->setReviews($reviews);
    }

    public function toString() {
        $toString = "Film[id=" . $this->id . "][idFilmType=" . $this->idFilmType . "][idDirector=" . $this->idDirector . "][name=" . $this->name . "][price=" . $this->price . "][image=" . $this->image . "][inSale=" . $this->inSale . "][rented=" . $this->rented . "]";
		return $toString;

    }
}
?>
