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
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/', {
      templateUrl: 'components/annonces/templates/accueil.html',
      controller: 'MainCtrl'
    })

    .when('/user', {
      templateUrl: 'components/users/templates/user.html',
      controller: 'userCtrl'
    })

    .when('/login', {
      templateUrl: 'components/login/templates/login.html',
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

    .when('/register', {
      templateUrl: 'components/register/templates/register.html',
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