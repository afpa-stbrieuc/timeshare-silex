'use strict';

angular.module('TimeShareSilex')
	.controller('navCtrl', ['$scope', '$location', '$route', 'userAuth', function($scope, $location, $route, userAuth) {
		//userAuth doesn't work
		$scope.isLogged = userAuth.checkIfSession();
		
		$scope.logoutUser = function() {
			console.log('test');
			userAuth.clearSession();
			if ($location.path() === '/') {
				$route.reload();
			} else {
				$location.path('/');
			}
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