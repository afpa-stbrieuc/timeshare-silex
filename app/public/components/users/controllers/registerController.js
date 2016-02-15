'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')

  
    .controller('registerCtrl', function($scope, $http){
        
//    $http({
//        method : 'GET',
//        url : '/api/user'
//      }).then(function (response){
//        $scope.user = response.data;
//      },function(response){
//        $scope.user = response.statusText;
//      });
      
        

        
    $scope.inscription = function(){
        
        $http({
            method : 'post',
            url : '/api/user',
            data : {
                firstname : $scope.prenom,
                surname : $scope.nom,
                town : $scope.ville
            }
        });
      
        
       
        
 
 
            
  
    
    
        
    };        
    });