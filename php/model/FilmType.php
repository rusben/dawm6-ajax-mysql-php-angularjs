<?php
/** FilmType.php
 * Entity FilmType
 * autor  Roberto Plana
 * version 2012/09
 */
require_once "EntityInterface.php";

class FilmType implements EntityInterface   {
    private $id;
    private $name;


    //----------Data base Values---------------------------------------
    private static $tableName = "filmTypes";
    private static $colNameId = "id";
    private static $colNameName = "name";


    function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }


    public function setId($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }


    public function getAll() {
		$data = array();
		$data["id"] = $this->id;
		$data["name"] = $this->name;

		return $data;
    }

    public function setAll($id, $name, $surname1, $surname2) {
		$this->setId($id);
		$this->setName($name);
    }


    public function toString() {
        $toString .= "FilmType[id=" . $this->id . "][name=" . $this->name . "]";
		return $toString;

    }
}
?>
