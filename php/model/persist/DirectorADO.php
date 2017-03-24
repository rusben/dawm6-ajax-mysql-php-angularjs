<?php
/** DirectorADO.php
 * Entity DirectorADO
 * autor  Roberto Plana
 * version 2012/09
 */
require_once "BDvideoclub.php";
require_once "EntityInterfaceADO.php";
require_once "../model/Director.php";

class DirectorADO implements EntityInterfaceADO {

    function __construct() {
    }

    //----------Data base Values---------------------------------------
    private static $tableName = "directors";
    private static $colNameId = "id";
    private static $colNameName = "name";
    private static $colNameSurname1 = "surname1";
    private static $colNameSurname2 = "surname2";

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
			$entity = DirectorADO::fromResultSet( $row );

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
		$id = $res[ DirectorADO::$colNameId];
		$name = $res[ DirectorADO::$colNameName ];
        $surname1 = $res[ DirectorADO::$colNameSurname1 ];
        $surname2 = $res[ DirectorADO::$colNameSurname2 ];


       	//Object construction
       	$entity = new Director();
		$entity->setId($id);
		$entity->setName($name);
		$entity->setSurname1($surname1);
		$entity->setSurname2($surname2);

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
			error_log("Error executing query in DirectorADO: " . $e->getMessage() . " ");
			die();
		}

		//Run the query
		$res = $conn->execution($cons, $vector);

		return DirectorADO::fromResultSetList( $res );
    }

    /**
	 * findById()
	 * It runs a query and returns an object array
	 * @param id
	 * @return object with the query results
    */
    public static function findById( $director ) {
		$cons = "select * from `".DirectorADO::$tableName."` where ".DirectorADO::$colNameId." = ?";
		$arrayValues = [$director->getId()];

		return DirectorADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findlikeName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findlikeName( $director ) {
		$cons = "select * from `".DirectorADO::$tableName."` where ".DirectorADO::$colNameName." like ?";
		$arrayValues = ["%".$director->getName()."%"];

		return DirectorADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findlikeSurname1()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findlikeSurname1( $director ) {
		$cons = "select * from `".DirectorADO::$tableName."` where ".DirectorADO::$colNameSurname1." like ?";
		$arrayValues = ["%".$director->getSurname1()."%"];

		return DirectorADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findlikeSurname2()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findlikeSurname2($director) {
		$cons = "select * from `".DirectorADO::$tableName."` where ".DirectorADO::$colNameSurname2." like ?";
		$arrayValues = ["%".$director->getSurname2()."%"];

		return DirectorADO::findByQuery( $cons, $arrayValues );
    }

    /**
	* findByName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByName( $director ) {
		$cons = "select * from `".DirectorADO::$tableName."` where ".DirectorADO::$colNameName." = ?";
		$arrayValues = [$director->getName()];

		return DirectorADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findAll()
	 * It runs a query and returns an object array
	 * @param none
	 * @return object with the query results
    */
    public static function findAll() {
    	$cons = "select * from `".DirectorADO::$tableName."`";
		$arrayValues = [];

		return DirectorADO::findByQuery( $cons, $arrayValues );
    }


    /**
	 * create()
	 * insert a new row into the database
    */
    public function create($director) {
		//Connection with the database
	    try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="insert into ".DirectorADO::$tableName." (`name`,`surname1`,`surname2`) values (?, ?, ?)";
		$arrayValues= [$director->getName(),$director->getSurname1(), $director->getSurname1()];

		$id = $conn->executionInsert($cons, $arrayValues);

		$director->setId($id);

	    return $director->getId();
	}

    /**
	 * delete()
	 * it deletes a row from the database
    */
    public function delete($director) {
		//Connection with the database
	    try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}


		$cons="delete from `".DirectorADO::$tableName."` where ".DirectorADO::$colNameId." = ?";
		$arrayValues= [$director->getId()];

		$conn->execution($cons, $arrayValues);
    }


    /**
	 * update()
	 * it updates a row of the database
    */
    public function update($director) {
		//Connection with the database
	    try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="update `".DirectorADO::$tableName."` set ".DirectorADO::$colNameName." = ?, ".DirectorADO::$colNameSurname1." = ?, ".DirectorADO::$colNameSurname2." = ? where ".userADO::$colNameId." = ?" ;
		$arrayValues= [$director->getName(),$director->getSurname1(), $director->getSurname2(), $director->getId()];

		$conn->execution($cons, $arrayValues);
    }

}
?>
