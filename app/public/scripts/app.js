'use strict';
//register all modules
angular.module('mytodoApp', [
  'ngRoute',
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ui.sortable',
  'pascalprecht.translate',
  'xeditable',
  'ui.bootstrap',
  'dialogs.main' //https://github.com/m-e-conroy/angular-dialog-service
])
  .config(['$routeProvider', function($routeProvider){
    $routeProvider
      .when('/', {
        templateUrl: 'views/todos.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  }])
  .config(['$resourceProvider', function($resourceProvider) {
    // this is to allow calling GET /todos/ instead of /todos
    $resourceProvider.defaults.stripTrailingSlashes = false;
  }])
  .config(['dialogsProvider',function(dialogsProvider){

    dialogsProvider.setSize('sm');
  }])
  .config(['$translateProvider',function($translateProvider){
    
    $translateProvider.useSanitizeValueStrategy('sanitize');
    $translateProvider.preferredLanguage('en-US');

    $translateProvider.translations('en-US',{
      DIALOGS_OK: 'OK'
    });

  }])
  .factory('Todo', ['$resource', function($resource){
      return $resource('/api/todos/:id', {id:'@id'}, {
        update: {
          method: 'PUT' // this method issues a PUT request
        }
      });
    }])
  .run(function(editableOptions) {
      editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    });
