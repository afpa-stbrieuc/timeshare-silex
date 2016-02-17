'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
  .controller('accueilCtrl', function($scope, $http) {
    
    //get all categories
    $http({
        method : 'GET',
        url : '/api/categorie'
      }).then(function (response){
        $scope.categories = response.data;
      },function(response){
        $scope.categories = response.statusText;
      });
    
    //get all location    
    $http({
        method : 'GET',
        url : '/api/location'
      }).then(function (response){
        $scope.locations = response.data;
      },function(response){
        $scope.locations = response.statusText;
      });
    
<<<<<<< HEAD
    $http({
        method : 'GET',
        url : '/api/location'
      }).then(function (response){
        $scope.locations = response.data;
      },function(response){
        $scope.locations = response.statusText;
      });
    


=======


>>>>>>> 122a6780b561b6dff590275ffacbe9b8535bca61
// show the annonces depending their categories and locations
    $scope.showannonces = function(){
      
      $http({
        method : 'GET' ,
        url : '/api/annonces/'+ $scope.myCategory +'/'+$scope.myLocation
      }) .then(function (response){
        $scope.annonces = response.data;
      },function(response){
        $scope.annonces = response.statusText;
      });
    };
<<<<<<< HEAD
  });
=======
  });
  
>>>>>>> 122a6780b561b6dff590275ffacbe9b8535bca61
