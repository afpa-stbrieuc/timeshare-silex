'use strict';

angular.module('TimeShareSilex')
  .controller('userCtrl', function($scope, $http) {

    this.user = {surname:'test', lastname: 'test', town: 'test'};

    this.tab = 1;

    this.selectTab = function(setTab) {
      $scope.tab = setTab;
    };

    this.isSelectedTab = function(checkTab) {
      return $scope.tab === checkTab;
    };

    $http({
      method: 'GET',
      url: '/api/user'
    }).then(function(response) {
      $scope.users = response.data;
    }, function(response) {
      $scope.users = response.statusText;
    });


  });


// //fetch alluser infos:
// $http({
//   method: 'GET',
//   url: 'api/user'
// }).then(function successCallback(response) {
//     // $scope callback will be called asynchronously
//     // when the response is available
//     $scope.users = response.data;

//   }, function errorCallback(response) {
//     // called asynchronously if an error occurs
//     // or server returns response with an error status.
//     $scope.users = response.statusText;

//   });
// });