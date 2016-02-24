'use strict';
//register all modules
angular.module('TimeShareSilex', [
  'ngRoute',
  'ngCookies',
//  'ngResource',
//  'ngSanitize',
//  'ui.sortable',
//  'pascalprecht.translate',
//  'xeditable',
  'ui.bootstrap'
//  'dialogs.main' //https://github.com/m-e-conroy/angular-dialog-service
])
  .config(['$routeProvider', function($routeProvider){
    $routeProvider
      .when('/', {
        templateUrl: 'components/annonces/templates/accueil.html',
        controller: 'accueilCtrl'
      })

    .when('/user', {
        templateUrl: 'components/users/templates/user.html',
        controller: 'userCtrl',
        controllerAs: 'panel'
      })

    .when('/login', {
        templateUrl: 'components/users/templates/login.html',
        controller: 'loginCtrl',
        controllerAs: 'vm'
      })

    .when('/annonce/:id', {
        templateUrl: 'components/annonces/templates/annonce.html',
        controller: 'annonceCtrl'
      })
      
    .when('/editAnnonce/:id', {
        templateUrl: 'components/annonces/templates/editAnnonce.html',
        controller: 'editCtrl',
        controllerAs: 'edit'
      })

    .when('/service', {
        templateUrl: 'components/services/templates/service.html',
        controller: 'serviceCtrl'
      })

      .when('/service/:id', {
          templateUrl: 'components/services/templates/service.html',
          controller: 'serviceCtrl'
        })

    .when('/inscription', {
          templateUrl: 'components/users/templates/inscription.html',
          controller: 'inscriptionCtrl'
        })

      .when('/publish/:type', {
          templateUrl: 'components/annonces/templates/publish.html',
          controller: 'publishCtrl',
          controllerAs: 'publish',
        })

          .when('/register', {
          templateUrl: 'components/users/templates/register.html',
          controller: 'registerCtrl'
        })

      .when('/logout', {
          templateUrl: 'components/users/templates/login.html',
          controller: 'logoutCtrl'
        })

    .otherwise({
          redirectTo: '/'
        });
  }]);
