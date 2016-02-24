'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')

  
    .controller('registerCtrl',['$scope','$http','$location', function($scope, $http, $location){
        
        $scope.user = {};
       
        $scope.userOk = false;
        $scope.userError = false;
        
        
        $scope.inscription = function(){
        
          $http({
            method : 'post',
            url : '/api/user/',
            data : $scope.user
            
          })
            
            .then(function(data){
                
                if (data.status === 201){
                 
                  $scope.userOk = true;
                  $location.path('/user');

                }
               
              },
            function(data){
                    if(data.status !== 201){
                      $scope.userError = true;
                    }
                  }
            );
               
        };
      }]);