'use strict';
//register all modules
angular.module('TimeShareSilex', [
    'ngRoute'
//  'ngCookies',
//  'ngResource',
//  'ngSanitize',
//  'ui.sortable',
//  'pascalprecht.translate',
//  'xeditable',
//  'ui.bootstrap',
//  'dialogs.main' //https://github.com/m-e-conroy/angular-dialog-service
])
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'components/annonces/templates/accueil.html',
                controller: 'accueilCtrl'
            })

    .when('/user', {
        templateUrl: 'components/users/templates/user.html',
        controller: 'userCtrl'
      })

    .when('/login', {
        templateUrl: 'components/users/templates/login.html',
        controller: 'loginCtrl',
                resolve: {
          'check': function($location, $rootScope) {
            if (!$rootScope.loggedIn) {
              $location.path('/login');
                        } else {
              $location.path('/user');
                        }
          }
        }
      })
    
      .when('/user', {
        templateUrl: 'components/users/templates/user.html',
        controller: 'userCtrl',
        controllerAs: 'panel'
      })
      
      .when('/annonce/:id', {
        templateUrl: 'components/annonces/templates/annonce.html',
        controller: 'annonceCtrl'
      })
      
      .when('/service', {
          templateUrl: 'components/services/templates/service.html',
          controller: 'serviceCtrl'
        })
      
      .when('/inscription', {
          templateUrl: 'components/users/templates/inscription.html',
          controller: 'inscriptionCtrl'
        })

      .when('/login', {
          templateUrl: 'components/users/templates/login.html',
          controller: 'loginCtrl',
          resolve: {
                    'check': function($location, $rootScope) {
              if (!$rootScope.loggedIn) {
                $location.path('/login');
              } else {
                $location.path('/user');
              }
            }
          }
        })

      .when('/publish', {
          templateUrl: 'components/annonces/templates/publish.html',
          controller: 'publishCtrl',
          controllerAs: 'publish',
        })

      .when('/register', {
          templateUrl: 'components/users/templates/register.html',
          controller: 'registerCtrl'
        })

    .otherwise({
          redirectTo: '/'
        });
  }])
  //  .config(['$resourceProvider', function($resourceProvider) {
  //    // this is to allow calling GET /todos/ instead of /todos
  //    $resourceProvider.defaults.stripTrailingSlashes = false;
  //  }])
  //  .config(['dialogsProvider',function(dialogsProvider){
  //
  //    dialogsProvider.setSize('sm');
  //  }])
  //  .config(['$translateProvider',function($translateProvider){
  //    
  //    $translateProvider.useSanitizeValueStrategy('sanitize');
  //    $translateProvider.preferredLanguage('en-US');
  //
  //    $translateProvider.translations('en-US',{
  //      DIALOGS_OK: 'OK'
  //    });
  //
  //  }])
  //
  //  .run(function(editableOptions) {
  //      editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
  //    })
;
