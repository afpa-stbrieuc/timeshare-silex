'use strict';

angular.module('TimeShareSilex')
  .controller('offresCtrl', function($scope, $http,$routeParams) {
      
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