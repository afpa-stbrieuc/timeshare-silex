'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')

  
    .controller('inscriptionCtrl', function($scope, $http){
        
    $scope.inscription = function(){
        
        $http({
            method : "POST",
            url : "/api/user"
        }).then(function (response){
            $scope.user = response.data;
            $scope.message = 'Merci Monsieur ' +$scope.user.surname +' Votre inscription a bien été prise en compte!'
        },function(response){
            $scope.user = response.statusText;
            $scope.message = 'Désolé. /n Une erreur est parvenue.'
        });
    
    }    
        
            
  });