<?php
/** userClass.php
* Entity userClass
* autor  Roberto Plana
* version 2012/09
*/
require_once "BDvideoclub.php";
require_once "EntityInterfaceADO.php";
require_once "ReviewADO.php";
require_once "../model/Film.php";
require_once "../model/Review.php";

class FilmADO implements EntityInterfaceADO {

  //----------Data base Values---------------------------------------
  private static $tableName = "films";
  private static $colNameId = "id";
  private static $colNameIdFilmType = "idFilmType";
  private static $colNameIdDirector = "idDirector";
  private static $colNameName = "name";
  private static $colNamePrice = "price";
  private static $colNameImage = "image";
  private static $colNameInSale = "inSale";
  private static $colNameRented = "rented";


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
      $entity = FilmADO::fromResultSet( $row );

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
    $id = $res[ FilmADO::$colNameId];
    $idFilmType = $res[ FilmADO::$colNameIdFilmType ];
    $idDirector = $res[ FilmADO::$colNameIdDirector ];
    $name = $res[ FilmADO::$colNameName ];
    $price = $res[ FilmADO::$colNamePrice ];
    $image = $res[ FilmADO::$colNameImage ];
    $inSale = $res[ FilmADO::$colNameInSale ];
    $rented = $res[ FilmADO::$colNameRented ];

    //Object construction
    $entity = new Film();
    $entity->setId($id);
    $entity->setIdFilmType($idFilmType);
    $entity->setIdDirector($idDirector);
    $entity->setName($name);
    $entity->setPrice($price);
    $entity->setImage($image);
    $entity->setInSale($inSale);
    $entity->setRented($rented);

    $review = new Review();
    $review->setIdFilm($entity->getId());

    $entity->setReviews(ReviewADO::findByIdFilm($review));

    return $entity;
  }

  /**
  * findByQuery()
  * It runs a particular query and returns the result
  * @param cons query to run
  * @return objects collection
  */
  public static function findByQuery( $cons, $vector ) {
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error executing query.";
      error_log("Error executing query in FilmADO: " . $e->getMessage() . " ");
      die();
    }

    //Run the query
    $res = $conn->execution($cons, $vector);

    return FilmADO::fromResultSetList( $res );
  }

  /**
  * findById()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findById( $film ) {
    $cons = "select * from `".FilmADO::$tableName."` where ".FilmADO::$colNameId." = ?";
    $arrayValues = [$film->getId()];

    return FilmADO::findByQuery( $cons, $arrayValues );
  }


  /**
  * findByIdDirector()
  * It runs a query and returns an object array
  * @param name
  * @return object with the query results
  */
  public static function findByIdDirector( $film ) {
    $cons = "select * from `".FilmADO::$tableName."` where ".FilmADO::$colNameIdDirector." = ?";
    $arrayValues = [$film->getIdDirector()];

    return FilmADO::findByQuery( $cons, $arrayValues );
  }


  /**
  * findAll()
  * It runs a query and returns an object array
  * @param none
  * @return object with the query results
  */
  public static function findAll() {
    $cons = "select * from `".FilmADO::$tableName."`";
    return FilmADO::findByQuery( $cons, [] );
  }

  /**
  * findLikeName()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikeName( $film ) {
    $cons = "select * from `".FilmADO::$tableName."` where ".FilmADO::$colNameName." like \"%".$film->getName()."%\"";
    $arrayValues = [];

    return FilmADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * findLikeNameAndIdDirector()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikeNameAndIdDirector( $film ) {
    $cons = "select * from `".FilmADO::$tableName."` where ".FilmADO::$colNameName." like ? and ".FilmADO::$colNameIdDirector." = ?";
    $arrayValues = ["%".$film->getIdDirector()."%",$film->getIdDirector()];

    return FilmADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * findLikePrice()
  * It runs a query and returns an object array
  * @param id
  * @return object with the query results
  */
  public static function findLikePrice( $film ) {
    $cons = "select * from `".FilmADO::$tableName."` where ".FilmADO::$colNamePrice." like ?";
    $arrayValues = ["%".$film->getPrice()."%"];

    return FilmADO::findByQuery( $cons, $arrayValues );
  }

  /**
  * create()
  * insert a new row into the database
  */
  public function create($film) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in create in FilmADO: " . $e->getMessage() . " ");
      die();
    }

    $cons="insert into ".FilmADO::$tableName." (`idFilmType`,`idDirector`,`name`,`price`,`image`,`inSale`,`rented`) values (?, ?, ?, ?, ?, ?, ?)" ;
    $arrayValues= [$film->getIdFilmType(),$film->getIdDirector(), $film->getName(), $film->getPrice(), $film->getImage(), ((int) $film->getInSale()), ((int) $film->getRented())];

    $id = $conn->executionInsert($cons, $arrayValues);

    $film->setId($id);

    return $film->getId();
  }

  /**
  * delete()
  * it deletes a row from the database
  */
  public function delete($film) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      echo "Error connecting database: " . $e->getMessage() . " ";
      error_log("Error in delete in FilmADO: " . $e->getMessage() . " ");
      die();
    }


    $cons="delete from `".FilmADO::$tableName."` where ".FilmADO::$colNameId." = ?";
    $arrayValues= [$film->getId()];

    $conn->execution($cons, $arrayValues);
  }


  /**
  * update()
  * it updates a row of the database
  */
  public function update($film) {
    //Connection with the database
    try {
      $conn = DBConnect::getInstance();
    }
    catch (PDOException $e) {
      print "Error connecting database: " . $e->getMessage() . " ";
      die();
    }

    $cons="update `".FilmADO::$tableName."` set ".FilmADO::$colNameIdFilmType." = ?,".FilmADO::$colNameIdDirector." = ?,".FilmADO::$colNameName." = ?,".
    FilmADO::$colNamePrice." = ?, ".FilmADO::$colNameImage." = ?, ".FilmADO::$colNameInSale." = ?, ".FilmADO::$colNameRented." = ? where ".FilmADO::$colNameId." = ?";
    $arrayValues= [$film->getIdFilmType(),$film->getIdDirector(), $film->getName(), $film->getPrice(), $film->getImage(), ((int) $film->getInSale()), ((int) $film->getRented()), $film->getId()];

    $conn->execution($cons, $arrayValues);

  }
}
?>
