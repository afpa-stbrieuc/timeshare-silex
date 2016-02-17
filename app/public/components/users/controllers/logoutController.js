'use strict';

angular.module('TimeShareSilex')

.controller('logoutCtrl', function($scope, $location, $rootScope)
  {
    $scope.username === 'null';
    $scope.password === 'null';
    $rootScope.loggedIn = false;
    $rootScope.userLogged = 'null';
    $location.path('/login');
  }
      };
    });