'use strict';

angular.module('TimeShareSilex')

.controller('loginCtrl', ['$location', '$window', 'userAuth', '$cookies', function($location, $window, userAuth, $cookies) {

  var vm = this;

  vm.submit = function() {
    //console
    console.log('submit 1', vm.userEmail);

    userAuth
      .login(vm.userEmail, vm.userPassword)
      .then(function(){
        // console.log('redirection to user', vm.userPassword);
        $location.path('/user');
      });
    console.log('submit 2', vm.userEmail, vm.userPassword);
  };

  console.log('controller login FIN', $cookies.getAll());
}]);
