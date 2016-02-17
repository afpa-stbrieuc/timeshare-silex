'use strict';

angular.module('TimeShareSilex')

.controller('loginCtrl', function($scope, $location, $rootScope, userAuth)
  {
      var vm = this;
      //on met oas submit()???? vm.submit?? qui verifie si ca matche le controlleur ou services??
      vm.login = function(){

        // if $scope.username =  username /*DBDBD de service */   &&   $scope.password = password /*DBDBDB de service*/;
        //   {
          // $rootScope.loggedIn = true;
          // $rootScope.userLogged = 'Bob';
          $location.path('/user');
        } 
        .then(function(){
          $location.path
          loginError
          $scope.loginError = 'Invalid username/password combination';
        }
      };
    });
