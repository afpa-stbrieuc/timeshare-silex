'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
  .controller('annonceCtrl', function($scope, $http,$routeParams) {
      
      console.log('annonceId',$routeParams.id);
      
      $http({
        method : 'GET' ,
        url : '/api/annonces/' + $routeParams.id
      }) .then(function (response){
        $scope.annonce = response.data;
      },function(response){
        $scope.annonce = response.statusText;
      });
      
    });
