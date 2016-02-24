'use strict';

angular.module('TimeShareSilex')
  .controller('userCtrl', ['$scope', '$http', '$cookies', function($scope, $http, $cookies) {

    var vm = this;

    vm.tab = 1;
    vm.sent = false;

    vm.alert = {'type': '', 'msg': ''};

    vm.user = $cookies.getObject('timeshareCookie');

    vm.selectTab = function(setTab) {
      vm.tab = setTab;
    };

    vm.isSelectedTab = function(checkTab) {
      return vm.tab === checkTab;
    };

    vm.modifyUser = function(valid) {
      if (valid) {
        $http.put('/api/user/'+vm.user.id, vm.user
        ).then(function(response) {
          if (response.status === 200)
            vm.alert = {'type': 'success', 'msg':'Annonce modifiée'};
          }, function(){
            vm.alert = {'type': 'danger', 'msg':'Erreur Serveur'};
          });
      } else {
        vm.alert = {
          type: 'danger',
          msg: 'Un champ requis est manquant'
        };
      }

    };

    $http.get('/api/annonces/?userId='+vm.id)
    .then(function(response) {
      vm.annonces = response.data;
    }, function() {
      // error
    });

    vm.closeAlert = function() {
      vm.altert = {'type': '', 'msg': ''};
    }
  }]);