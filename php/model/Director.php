<?php
/** Director.php
 * Entity Director
 * autor  Roberto Plana
 * version 2012/09
 */
require_once "EntityInterface.php";
class Director implements EntityInterface {
    private $id;
    private $name;
    private $surname1;
    private $surname2;


    function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname1() {
        return $this->surname1;
    }

    public function getSurname2() {
        return $this->surname2;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname1($surname1) {
        $this->surname1 = $surname1;
    }

    public function setSurname2($surname2) {
        $this->surname2 = $surname2;
    }

    public function getAll() {
		$data = array();
		$data["id"] = $this->id;
		$data["name"] = $this->name;
		$data["surname1"] = $this->surname1;
		$data["surname2"] = $this->surname2;

		return $data;
    }

    public function setAll($id, $name, $surname1, $surname2) {
		$this->setId($id);
		$this->setName($name);
		$this->setSurname1($surname1);
		$this->setSurname2($surname2);
    }


    public function toString() {
        $toString .= "Director[id=" . $this->id . "][name=" . $this->name . "][surname1=" . $this->surname1 . "][surname2=" . $this->surname2 . "]";
		return $toString;

    }
}
?>
