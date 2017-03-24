<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/
require_once "ControllerInterface.php";
require_once "../model/User.php";
require_once "../model/persist/UserADO.php";


class UserControllerClass implements ControllerInterface {
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
			case 10000:
				$outPutData = $this->userConnection();
				break;
			case 10010:
				$outPutData = $this->entryUser();
				break;
			case 10020:
				$outPutData = $this->modifyUser();
				break;
			case 10030:
				$outPutData = $this->sessionControl();
				break;
			case 10040:
				//Closing session
				session_unset();
				session_destroy();
				$outPutData[0]=true;
				break;
			default:
				$errors = array();
				$outPutData[0]= false;
				$errors[]= "Sorry, there has been an error. Try later";
				$outPutData[]= $errors;
				error_log("Action not correct in UserControllerClass, value: ".$this->getAction());
				break;
		}

		return $outPutData;
	}

	private function entryUser()
	{
		$userObj = json_decode(stripslashes($this->getJsonData()));

		$user = new User();
		$user->setAll(0, $userObj->name, $userObj->surname1, $userObj->nick, $userObj->password, $userObj->address, $userObj->telephone, $userObj->mail, $userObj->birthDate, date("Y-m-d h:i:sa"), "0000-00-00", $userObj->active, $userObj->image);


		$outPutData = array();
		$outPutData[]= true;
		$user->setId(userADO::create($user));

		//the senetnce returns de id of the user inserted
		$outPutData[]= array($user->getAll());

		return $outPutData;
	}

	private function modifyUser()
	{
		//Films modification
		$usersArray = json_decode(stripslashes($this->getJsonData()));
		$outPutData = array();
		$outPutData[]= true;

		foreach($usersArray as $userObj)
		{
		    $user = new User();
			$user->setAll($userObj->id, $userObj->name, $userObj->surname1, $userObj->nick, $userObj->password, $userObj->address, $userObj->telephone, $userObj->mail, $userObj->birthDate, $userObj->entryDate, $userObj->dropOutDate, $userObj->active, $userObj->image);
		    userADO::update($user);
		}

		return $outPutData;
	}


	private function userConnection()
	{
    // $outPutData[0] --> response status
    // $outPutData[1] --> data

		$userObj = json_decode(stripslashes($this->getJsonData()));

		$outPutData = array();
		$errors = array();
		$outPutData[0]=true;

		$user = new User();
		$user->setNick($userObj->nick);
		$user->setPassword($userObj->password);

		$userList = userADO::findByNickAndPass($user);

		if (count($userList)==0)
		{
			$outPutData[0]=false;
			$errors[]="No user has found with these data";
			$outPutData[1]=$errors;
		}
		else
		{
			$usersArray=array();

			foreach ($userList as $user)
			{
				$usersArray[]=$user->getAll();
			}

			$_SESSION['connectedUser'] = $userList[0];

			$outPutData[1]=$usersArray;
		}

		return $outPutData;
	}

	private function sessionControl()
	{
		$outPutData = array();
		$outPutData[]= true;

		if(isset($_SESSION['connectedUser']))
		{
			$outPutData[]=$_SESSION['connectedUser']->getAll();
		}
		else
		{
			$outPutData[0]=false;
			$errors[]="No session opened";
			$outPutData[1]=$errors;
		}

		return 	$outPutData;
	}
}
?>
