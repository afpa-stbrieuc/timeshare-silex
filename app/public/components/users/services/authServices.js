'use strict';

(function() {
  angular
    .module('TimeShareSilex')
    .service('userAuth', ['$location','$http', '$cookies', '$rootScope', function($location, $http, $cookies, $rootScope) {

      var isLogged = false;
      //check if any current session
      function checkIfSession() {
        var userCookie = $cookies.get('userSession', $rootScope.userSession);
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
            $rootScope.userSession = userSessionData;
            console.log('userAuth.login 2', userSessionData);
            //creates cookie
            $cookies.put('cookie', userSessionData);
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