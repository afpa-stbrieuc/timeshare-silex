'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
  .controller('userCtrl', function($scope, $http){
  
              
              
    $http({
        method : "GET",
        url : "/api/user"
    }).then(function (response){
        $scope.users = response.data;
    },function(response){
        $scope.users = response.statusText;
    });
      
});
