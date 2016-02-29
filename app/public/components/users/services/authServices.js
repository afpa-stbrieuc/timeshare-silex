'use strict';

(function() {
  angular
    .module('TimeShareSilex')
    .service('userAuth', ['$location','$http', '$cookies', '$rootScope', function($location, $http, $cookies, $rootScope) {

      var isLoggedIn = false;

      //check if any current session
      function checkIfSession() {
        var userCookie = $cookies.getObject('timeshareCookie');
        // console.log($cookies.get('userSession', $rootScope.userSession));
        if (userCookie) {
          return isLoggedIn = true;
        } else {
          return false;
        }
      }

      function isLogged() {
        return isLoggedIn;
      }

      //logout by clearing $cookies
      function clearSession() {
        $rootScope.userSession = {};
        $cookies.remove('timeshareCookie');
        //console.log($cookies.get('userSession'));
        isLoggedIn = false;
      }

      //login & setuserSession
      function login(userEmail, userPassword) {

        //console.log('userAuth.login 1', userEmail, userPassword);

        $http.post('/api/user/login', {
            email: userEmail,
            password: userPassword
          })
          .then(function(userSessionData) {
            $rootScope.userSession = userSessionData.data;
            //console.log('userAuth.login 2', userSessionData.data);
            //creates cookie
            $cookies.putObject('timeshareCookie', userSessionData.data);

            //console.log($cookies.getAll());
            isLoggedIn = true;
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