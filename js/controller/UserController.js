//Angular code
(function (){
	angular.module('videoclubApp').controller("UserController", ['$http','$scope', '$window', '$cookies','accessService', 'userConnected',function ($http, $scope, $window, $cookies, accessService, userConnected){

		//scope variables
		$scope.user = new User();

    if(sessionStorage.userConnected != undefined) {
      var obj = JSON.parse(sessionStorage.userConnected);
      $scope.user.construct(obj.id, obj.name, obj.surname1, obj.nick, obj.password,
        obj.address, obj.telephone, obj.mail, new Date(obj.birthDate), obj.entryDate,
        obj.dropOutDate, obj.active, obj.image);
    }


		$scope.userOption=0;

		$scope.passwordValid = true;
		$scope.nickValid = true;

		$scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
		$scope.format = $scope.formats[0];
		$scope.dateOptions = {
			dateDisabled: "",
			formatYear: 'yyyy',
			maxDate: new Date(),
			minDate: "",
			startingDay: 1
		};

		$scope.birthDate = {
			opened: false
		};

		$scope.openBirthDate = function() {
			$scope.birthDate.opened = true;
		};

		this.connection = function () {
			//copy
			$scope.user = angular.copy($scope.user);

			//Server conenction to verify user's data
			var promise = accessService.getData("php/controllers/MainController.php",
      true, "POST", {controllerType: 0, action: 10000, jsonData: JSON.stringify($scope.user)});

			promise.then(function (outputData) {
				if(outputData[0] === true) {
          //User correct, mainWindow is opened.
          sessionStorage.userConnected = JSON.stringify(outputData[1][0]);
          window.open("mainWindow.html", "_self");

				}
				else {
					if(angular.isArray(outputData[1])) {
						console.log(outputData);
					}
					else {alert("There has been an error in the server, try later");}
				}
			});
		}

    this.userManagement = function () {

      var imageFile = $("#imageUser")[0].files[0];

      var imagesArrayToSend = new FormData();
      imagesArrayToSend.append('images[]', imageFile);
      //imagesArrayToSend['images[]']

      $http({
      	method: 'POST',
      	url: 'php/controllers/MainController.php?controllerType=2&action=10010&jsonData=' + $scope.user.getNick(),
      	headers: {'Content-Type': undefined},
      	data: imagesArrayToSend,
      	transformRequest: function (data, headersGetterFunction) {
      		return data;
      	}
      }).success(function (outPutData) {
      	if (outPutData[0] === true) {
      		//File uploaded
      		$scope.user.setImage(outPutData[1][0]);
      		$scope.user.setActive(1);

      		$scope.user = angular.copy($scope.user);

      		var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType: 0, action: 10010, jsonData: JSON.stringify($scope.user)});

      		promise.then(function (outPutData) {
      			if (outPutData[0] === true) {
      				$scope.userOption=0;
      				$scope.userManagement.$setPristine();
      				$scope.user.setId(outPutData[1][0].id);
      				$scope.user.setEntryDate(outPutData[1][0].entryDate);
      				$scope.user.setDropOutDate(outPutData[1][0].dropOutDate);

      				sessionStorage.setItem("connectedUser", JSON.stringify($scope.user));
      				window.open("mainWindow.html", "_self");

      			} else {

      				if (angular.isArray(outPutData[1])) {
      					showErrors(outPutData[1]);
      				} else {
      					alert("There has been an error in the server, try later");
      				}
      			}
      		});

      	} else {
      		if (angular.isArray(outPutData[1])) {
      			showErrors(outPutData[1]);
      		} else {
      			alert("There has been an error in the server, try later");
      		}
      	}
      });
    }


		$scope.setFile = function(element) {
			$scope.currentFile = element.files[0];
			var reader = new FileReader();

			reader.onload = function(event) {
				$scope.userImage = event.target.result
				$scope.$apply();
			}

			// when the file is read it triggers the onload event above.
			reader.readAsDataURL(element.files[0]);
		}
	}]);

	angular.module('videoclubApp').directive("userDataManagement", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/user-data-management.html",
			controller:function(){

			},
			controllerAs: 'userDataManagement'
		};
	});

})();
