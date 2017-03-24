//JQuery code


//Angular code
(function (){
	//Application module
	angular.module('videoclubApp').controller("FilmController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function ($http, $scope, $window, $cookies, accessService, $filter){
		//scope variables
		$scope.shomForm=0;
		$scope.filmTypesArray = new Array();
		$scope.directorsArray = new Array();
		$scope.filmsArray = new Array();

		//Pagination variables
		$scope.pageSize = 4;
		$scope.currentPage = 1;


		this.loadInitData = function (){

		}

		this.addFilm = function () {
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


				} else
				{
					if (angular.isArray(outPutData[1]))
					{
						console.log(outPutData[1]);
					} else {
						alert("There has been an error in the server, try later");
					}
				}
			});
		}

		this.modFilms = function () {


		}

		this.loadFilms = function () {

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
