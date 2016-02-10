'use strict';

angular.module('TimeShareSilex')
  .controller('userCtrl', function($scope, $http) {

    var vm = this;

    vm.tab = 1;
    vm.sent = false;

    vm.selectTab = function(setTab) {
      vm.tab = setTab;
    };

    vm.isSelectedTab = function(checkTab) {
      return vm.tab === checkTab;
    };

    
    $http({
      method: 'GET',
      url: '/api/user/569d06ecc4936293a6f8fd90'
    }).then(function(response) {
      vm.user = response.data;
    }, function(response) {
      vm.user = {id:'569d06ecc4936293a6f8fd90', surname:'Karine', firstname: 'Monfort', town: 'Yffiniac', timebalance:15};
    });

    vm.modifyUser = function(valid) {
      if (valid) {
        var user = {
                  surname:vm.user.surname,
                  firstname:vm.user.firstname,
                  town:vm.user.town,
                  timebalance:vm.user.timebalance
            };
        $http.put('/api/user/'+vm.user.id, user
        ).then(function(response) {
            $scope.sent = true;
        }, function(response){
            $scope.sent = false;
        })   
      }
    };

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