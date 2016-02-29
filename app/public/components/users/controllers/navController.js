'use strict';

angular.module('TimeShareSilex')
	.controller('navCtrl', ['$scope', '$location', 'userAuth', function($scope, $location, userAuth) {
		//userAuth doesn't work
		$scope.isLogged = userAuth.checkIfSession();
		
		$scope.logoutUser = function() {
			console.log('test');
			userAuth.clearSession();
			$location.path('/');
		}
	}])
	.directive('tsNavigation', function() {
		return  {
			restrict: 'E',
			templateUrl: 'components/users/templates/navbar.html',
			replace: true,
			controller: 'navCtrl'
		}
	});