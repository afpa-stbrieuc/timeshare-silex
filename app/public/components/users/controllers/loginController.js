'use strict';

angular.module('TimeShareSilex')

.controller('loginCtrl', function($scope, $location, $rootScope)
  {
      $scope.submit = function()
      {
        if ($scope.username === 'bob' && $scope.password === '1')
          {
          $rootScope.loggedIn = true;
          $location.path('/user');
        } else{
          $scope.loginError = 'Invalid username/password combination';
        }
      };
    });