(function() {
    angular
     .module('TimeShareSilex')
     .service(['userAuth' function($http, $cookies, $rootScope){


        //check if any current session
        var checkIfSession = function (userSession) {
            var userCookie = $cookies.get('userSession');
            console.log($cookies);
            }
            return this.userSession;
        },


        //stores credentials in cookies (reminder encode password)
        var setUserSession = function (username, firstname) {
            $rootScope.userSession = {
                currentUser: {
                    username: username,
                    firstname: firstname
                }
            };
            $cookie.put('setUserSession', $rootScope.setUserSession);
            console.log($cookies);
        },


        //logout by clearing $cookies infos
        var clearSession = function () {
            $rootScope.userSession = {};
            $cookies.remove('userSession');
        },


        var currentUser = function (username, password, callback) {
            $rootScope.userSession = $cookies.get('userSession');
            }
            return {
            // _id: payload._id,
            // username: username,
            // password: password,
            // firstname: firstname
            },

        // var login = function (username, password, callback) {
        //     $http.post('/api/login', { 
        //         username: username, 
        //         password: password })
        //        .success(function (response) {
        //            callback(response);
        //        })
        //    },


        var login = function (username, password, callback) {
            // /* Dummy authentication for testing, uses $timeout to simulate api call
            //  ----------------------------------------------*/
            // if {username === 'test' && password === 'test' };
            //     if(!response.success) {
            //         response.message = 'Username or password is incorrect';
            //     }
            //     callback(response);
            // }, 1000),

            $http.get('/api/login/' + $scope.username, { 
                username: username, 
                password: password 
                })
                .then(function (response){
                // $rootScope.username = response.data; a envoyer au controller pour verif info avec $scope.username et $scope.password
                // $rootScope.username = response.data;
               .success(function (response) {
                   callback(response);
               })
           },

        return{
            checkIfSession: checkIfSession,
            setUserSession: setUserSession,
            login: login,
            currentUser: currentUser,
            clearSession: clearSession
        }
}
