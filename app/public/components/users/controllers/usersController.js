'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
  .controller('userCtrl', function($scope, $http) {

    //fetch all annonces'
//    $scope.annonces = Annonce.query(
//      function() {},
//      function(error) { //error
//          dialogs.error('Error', 'server error');
//          console.log(error.data);
//        }
//    );
    //get all categories
    
   $http({
       method : "GET",
       url : "/api/user"
   }).then(function (response){
       $scope.users = response.data;
   },function(response){
       $scope.users = response.statusText;
   });

  
  });
  

// //fetch alluser infos:
// $http({
//   method: 'GET',
//   url: 'api/user'
// }).then(function successCallback(response) {
//     // this callback will be called asynchronously
//     // when the response is available
//     $scope.users = response.data;

//   }, function errorCallback(response) {
//     // called asynchronously if an error occurs
//     // or server returns response with an error status.
//     $scope.users = response.statusText;

//   });
// });