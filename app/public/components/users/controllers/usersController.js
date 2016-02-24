'use strict';

angular.module('TimeShareSilex')
  .controller('userCtrl', function($scope, $http) {

    var vm = this;

    vm.tab = 1;
    vm.sent = false;

    vm.alert = {'type': '', 'msg': ''};

    vm.id = '569d06ecc4936293a6f8fd90'; // hard coded user id

    vm.selectTab = function(setTab) {
      vm.tab = setTab;
    };

    vm.isSelectedTab = function(checkTab) {
      return vm.tab === checkTab;
    };

    
    $http({
      method: 'GET',
      url: '/api/user/'+vm.id
    }).then(function(response) {
      vm.user = response.data;
    }, function() {
      vm.user = {id:vm.id, surname:'Karine', firstname: 'Monfort', town: 'Yffiniac', timebalance:15};
    });

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
  });