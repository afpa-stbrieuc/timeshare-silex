

'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
  .controller('MainCtrl', function($scope, $http) {

    //fetch all annonces'
//    $scope.annonces = Annonce.query(
//      function() {},
//      function(error) { //error
//          dialogs.error('Error', 'server error');
//          console.log(error.data);
//        }
//    );
    //get all categories
    
//    $http({
//        method : "GET",
//        url : "/api/categorie"
//    }).then(function (response){
//        $scope.categories = response.data;
//    },function(response){
//        $scope.categories = response.statusText;
//    });
    
    //get all location
    
//        $http({
//        method : "GET",
//        url : "/api/location"
//    }).then(function (response){
//        $scope.locations = response.data;
//    },function(response){
//        $scope.locations = response.statusText;
//    });
  $scope.categories =["jardinage","mécanique","construction","demenagement","aide à la personne","babysitting"];
  
  $scope.locations = ["Lannion","Paris", "Rennes" , "Saint-Brieuc" , "Nantes"];
  
  });
  

