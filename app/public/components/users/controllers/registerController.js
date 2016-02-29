'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')

  
    .controller('registerCtrl',['$scope','$http','$location','$timeout', function($scope, $http, $location,$timeout){
        
        $scope.user = {};
        $scope.disable = false;
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
                  $scope.disable = true;
                  $timeout(function(){
                  $location.path('/user');
                  },2000 );
                  
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