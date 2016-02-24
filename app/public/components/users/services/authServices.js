'use strict';

(function() {
  angular
    .module('TimeShareSilex')
    .service('userAuth', ['$location','$http', '$cookies', '$rootScope', function($location, $http, $cookies, $rootScope) {

      var isLogged = false;
      //check if any current session
      function checkIfSession() {
        // var userCookie = $cookies.getObject('cookie', $rootScope.userSession);
        // console.log($cookies.get('userSession', $rootScope.userSession));
      }

      function isLogged() {
        return isLogged;
      }

      //logout by clearing $cookies
      function clearSession() {
        $rootScope.userSession = {};
        $cookies.remove('userSession');
        console.log($cookies.get('userSession'));
      }

      //login & setuserSession
      function login(userEmail, userPassword) {

        console.log('userAuth.login 1', userEmail, userPassword);

        $http.post('/api/user/login', {
            email: userEmail,
            password: userPassword
          })
          .then(function(userSessionData) {
            $rootScope.userSession = userSessionData.data;
            console.log('userAuth.login 2', userSessionData.data);
            //creates cookie
            $cookies.putObject('timeshareCookie', userSessionData.data);

            console.log($cookies.getAll());
            isLogged = true;
            //redicrection to place in logincontroller
            $location.path('/user');
            //cookieStr = JSON.stringify($rootScope.userSession);
          });
      }

      return {
        isLogged: isLogged,
        checkIfSession: checkIfSession,
        login: login,
        clearSession: clearSession
      };
    }]);
})();