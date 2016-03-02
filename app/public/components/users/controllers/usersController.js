'use strict';

angular.module('TimeShareSilex')
  .controller('userCtrl', ['$scope', '$http', '$cookies', '$timeout', '$route','$window', function($scope, $http, $cookies, $timeout, $route,$window) {

    var vm = this;

    vm.tab = 1;
    vm.sent = false;
    vm.disabled = false;

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
            vm.alert = {'type': 'success', 'msg':'Utilisateur modifié(e)'};
            vm.disabled = true;
            $('#myAlert').delay(2000).fadeOut(400);
            $cookies.putObject('timeshareCookie', vm.user);
            $timeout(function() {
              $route.reload('/user');
            }, 3000);
        
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

    $http.get('/api/annonces/?userId='+vm.user.id)
    .then(function(response) {
      vm.annonces = response.data;
    }, function() {
      // error
    });
    


  }]);