(function() {
    angular
        .module('TimeShareSilex')
        .service('userAuth', ['$http', '$cookies', '$rootScope', function($http, $cookies, $rootScope) {


            //check if any current session
            function checkIfSession () {
                var userCookie = $cookies.get('userSession', $rootScope.userSession);
                console.log($cookies.get('userSession', $rootScope.userSession));
            };


            //logout by clearing $cookies infos
            function clearSession () {
                $rootScope.userSession = {};
                $cookies.remove('userSession');
                console.log($cookies.get('userSession'));
            };


            function login (userEmail, userPassword) {

                console.log('userAuth.login 1', userEmail, userPassword);

                $http.post('/api/user/login', {
                        email: userEmail,
                        password: userPassword
                    })
                    .then(function(userSessionData) {
                        $rootScope.userSession = userSessionData;
                        console.log("userAuth.login 2", userSessionData);
                                                //creates cookie
                        $cookies.put('cookie', userSessionData);
                        console.log($cookies.getAll());

                        //cookieStr = JSON.stringify($rootScope.userSession);
                    });
            };

            return {
                checkIfSession: checkIfSession,
                login: login,
                clearSession: clearSession
            };
        }]);
})();