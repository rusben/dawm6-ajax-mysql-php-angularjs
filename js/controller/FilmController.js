//JQuery code


//Angular code
(function (){
	//Application module
	angular.module('videoclubApp').controller("FilmController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function ($http, $scope, $window, $cookies, accessService, $filter){
		//scope variables
		$scope.showForm=0;
		$scope.filmTypesArray = new Array();
		$scope.directorsArray = new Array();
		$scope.filmsArray = new Array();

		//Pagination variables
		$scope.pageSize = 4;
		$scope.currentPage = 1;


		this.loadInitData = function (){
      //Server conenction to verify user's data
      var promise = accessService.getData("php/controllers/MainController.php",
      true, "POST", {controllerType: 1, action: 10000, jsonData: ""});

      promise.then(function (outputData) {
        if(outputData[0] === true) {
          for (var i = 0; i < outputData[1].length; i++) {
            var filmType = new FilmType();
            filmType.construct(outputData[1][i].id, outputData[1][i].name)
            $scope.filmTypesArray.push(filmType);
          }

          for (var i = 0; i < outputData[2].length; i++) {
            var director = new Director();
            director.construct(outputData[2][i].id, outputData[2][i].name, outputData[2][i].surname1, outputData[2][i].surname2);
            $scope.directorsArray.push(director);
          }

          $scope.addFilm();
        }
        else {
          if(angular.isArray(outputData[1])) {
            alert(outPutData[1]);
          }
          else {
            alert("There has been an error in the server, try later");
          }
        }
      });
    }

    $scope.addFilm = function () {
			var film = new Film();
			film.construct(0,$scope.filmTypesArray[0].getId(),$scope.directorsArray[0].getId(),"",0,"",false,false, []);
			$scope.filmsArray.push(film);
		}

		this.removeFilm = function (indexFilm)
		{
			if($scope.filmsArray.length ==1) {alert("At least one film must be inserted")}
			else {$scope.filmsArray.splice(indexFilm,1);}
		}

		this.entryFilm = function () {

			$scope.filmsArray = angular.copy($scope.filmsArray);

			//First uploading cloths images
			var imagesArrayToSend = new FormData();

			for (var i = 0; i < $scope.filmsArray.length; i++) {
				var imageFile = $("#filmImageEntry"+i)[0].files[0];
				imagesArrayToSend.append('images[]', imageFile);
			}

			//imagesArrayToSend['images[]']
			$http({
				method: 'POST',
				url: 'php/controllers/MainController.php?controllerType=2&action=10000&jsonData=""',
				headers: {'Content-Type': undefined},
				data: imagesArrayToSend,
				transformRequest: function (data, headersGetterFunction) {
					return data;
				}
			}).success(function (outPutData) {
				if (outPutData[0] === true) {
					//Files uploaded, next step insert films in database

          for (var i = 0; i < outPutData[1].length; i++) {
            $scope.filmsArray[i].setImage(outPutData[1][i]);
          }

          $scope.filmsArray = angular.copy($scope.filmsArray);

          var promise = accessService.getData("php/controllers/MainController.php",
          true, "POST", {controllerType: 1, action: 10010,
            jsonData: JSON.stringify($scope.filmsArray)});

          promise.then(function (outputData) {
            // Film inserted correctly
            if(outputData[0] === true) {
              // Initialize the form
              $scope.entryFilmsForm.$setPristine();

              $scope.filmsArray = [];
              var film = new Film();
							film.construct(0,$scope.filmTypesArray[0].getId(),$scope.directorsArray[0].getId(),"",0,"",false,false, []);
							$scope.filmsArray.push(film);

              // Initialize state
              $scope.showForm = 0;

              alert("Films inserted correctly");

            }
            else {
              if(angular.isArray(outputData[1])) {
                alert(outPutData[1]);
              }
              else {
                alert("There has been an error in the server, try later");
              }
            }
          });

				} else {
					if (angular.isArray(outPutData[1])) {
						alert(outPutData);
					} else {
						alert("There has been an error in the server, try later");
					}
				}
			});
		}

		this.modFilms = function () {
      $scope.filmsModArray = angular.copy($scope.filmsModArray);

			var promise = accessService.getData("php/controllers/MainController.php", true, "POST", {controllerType:1, action:10030 ,jsonData: JSON.stringify($scope.filmsModArray)});

			promise.then(function (outPutData) {
				if(outPutData[0]=== true)
				{
          //Form Initialize
					$scope.modFilmsForm.$setPristine();

					$scope.shomForm=0;

					alert("Films modfied correctly");
				}
				else
				{
					if(angular.isArray(outPutData[1]))
					{
            alert(outPutData[1]);
					}
					else {alert("There has been an error in the server, try later");}
				}

			});
		}

		this.loadFilms = function () {
      // Load all the films
      $scope.filmsModArray = [];

      var promise = accessService.getData("php/controllers/MainController.php", true, "POST",
      {controllerType:1, action:10020 ,jsonData: ""});

      promise.then(function (outPutData) {
        if(outPutData[0]=== true)
        {
          for (var i = 0; i < outPutData[1].length; i++)
          {
            var film = new Film();

            film.construct(outPutData[1][i].id,outPutData[1][i].idFilmType,outPutData[1][i].idDirector,outPutData[1][i].name,outPutData[1][i].price,outPutData[1][i].image,outPutData[1][i].inSale == 1 ? true:false,outPutData[1][i].rented == 1 ? true:false, outPutData[1][i].reviews);

            $scope.filmsModArray.push(film);
          }

          $scope.filteredData = $scope.filmsModArray;

        }
        else
        {
          if(angular.isArray(outPutData[1]))
          {
            alert(outPutData[1]);
          }
          else {alert("There has been an error in the server, try later");}
        }

      });
		}
	}]);




	angular.module('videoclubApp').directive("filmsEntryForm", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/films-entry-form.html",
			controller:function(){

			},
			controllerAs: 'filmsEntryForm'
		};
	});

	angular.module('videoclubApp').directive("filmsModForm", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/films-mod-form.html",
			controller:function(){

			},
			controllerAs: 'filmsModForm'
		};
	});
})();
