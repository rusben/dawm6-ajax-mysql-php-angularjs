//Angular code
(function (){

	angular.module('videoclubApp').controller("SessionController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected){

		//scope variables
		$scope.user = new User();
		$scope.userAction=0;
    $scope.sessionOpened=true;

		this.sessionControl = function ()
		{
			switch ($scope.userAction)
			{
				//Index.html is executed
				case 0:
					break;
				//mainWindow.html is executed
				case 1:

					break;
				default:
					console.log("user action not correcte: "+$scope.userAction);
					break;
			}
		}

		this.logOut = function ()
		{
			//Local session destroy

		}
	}]);
})();
