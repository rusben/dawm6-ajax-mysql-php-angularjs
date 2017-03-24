<?php
/** userClass.php
 * Entity userClass
 * autor  Roberto Plana
 * version 2012/09
 */
require_once "BDvideoclub.php";
require_once "EntityInterfaceADO.php";
require_once "../model/FilmType.php";

class FilmTypeADO implements EntityInterfaceADO {

    //----------Data base Values---------------------------------------
    private static $tableName = "filmTypes";
    private static $colNameId = "id";
    private static $colNameName = "name";

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
			$entity = FilmTypeADO::fromResultSet( $row );

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
		$id = $res[ FilmTypeADO::$colNameId];
		$name = $res[ FilmTypeADO::$colNameName ];


			//Object construction
		$entity = new FilmType();
		$entity->setId($id);
		$entity->setName($name);


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
			error_log("Error executing query in FilmTypeADO: " . $e->getMessage() . " ");
			die();
		}

		//Run the query
		$res = $conn->execution($cons, $vector);

		return FilmTypeADO::fromResultSetList( $res );
    }

    /**
	 * findById()
	 * It runs a query and returns an object array
	 * @param id
	 * @return object with the query results
    */
    public static function findById( $filmType ) {
		$cons = "select * from `".FilmTypeADO::$tableName."` where ".FilmTypeADO::$colNameId." = ?";
		$arrayValues = [$film->getId()];

		return FilmTypeADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findlikeName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findlikeName( $filmType ) {
		$cons = "select * from `".FilmTypeADO::$tableName."` where ".FilmTypeADO::$colNameName." like ?";
		$arrayValues = ["%".$film->getName()."%"];

		return FilmTypeADO::findByQuery( $cons, $arrayValues );
    }


    /**
	* findByName()
	 * It runs a query and returns an object array
	 * @param name
	 * @return object with the query results
    */
    public static function findByName( $filmType ) {
		$cons = "select * from `".FilmTypeADO::$tableName."` where ".FilmTypeADO::$colNameName." = ?";
		$arrayValues = [$film->getName()];

		return FilmTypeADO::findByQuery( $cons, $arrayValues );
    }

    /**
	 * findAll()
	 * It runs a query and returns an object array
	 * @param none
	 * @return object with the query results
    */
    public static function findAll() {
    	$cons = "select * from `".FilmTypeADO::$tableName."`";
    	$arrayValues = [];

		return FilmTypeADO::findByQuery( $cons, $arrayValues );
    }


    /**
	 * create()
	 * insert a new row into the database
    */
    public function create($filmType) {
		//Connection with the database
	    try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="insert into ".FilmTypeADO::$tableName." values (?)";
		$arrayValues= [$filmType->getName()];

		$id = $conn->executionInsert($cons, $arrayValues);

		$filmType->setId($id);

	    return $filmType->getId();
	}

    /**
	 * delete()
	 * it deletes a row from the database
    */
    public function delete($filmType) {
		//Connection with the database
        try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}


		$cons="delete from `".FilmTypeADO::$tableName."` where ".FilmTypeADO::$colNameId." = ?";
		$arrayValues= [$filmType->getId()];

		$conn->execution($cons, $arrayValues);
    }


    /**
	 * update()
	 * it updates a row of the database
    */
    public function update($filmType) {
		//Connection with the database

	    try {
			$conn = DBConnect::getInstance();
		}
		catch (PDOException $e) {
			print "Error connecting database: " . $e->getMessage() . " ";
			die();
		}

		$cons="update `".FilmTypeADO::$tableName."` set ".FilmTypeADO::$colNameName." = ? where ".FilmTypeADO::$colNameId." = ?";
		$arrayValues= [$filmType->getName(), $filmType->getId()];

		$conn->execution($cons, $arrayValues);

    }
}
?>
