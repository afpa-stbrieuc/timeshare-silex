'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
        .controller('serviceCtrl', ['$scope', '$http', '$routeParams', '$cookies', '$location', '$timeout', function ($scope, $http, $routeParams, $cookies, $location, $timeout) {

                $scope.crediteur = $cookies.getObject('timeshareCookie');
                $scope.disable = false;
                $scope.error = false;
                $scope.ok = false;

                //get the advert id
                $http({
                    method: 'GET',
                    url: '/api/annonces/' + $routeParams.id
                }).then(function (response) {
                    $scope.annonce = response.data;
                }, function (response) {
                    $scope.annonce = response.statusText;
                });

                $scope.createService = function () {

                    $http({
                        method: 'POST',
                        url: '/api/services/',
                        data: {
                            crediteur: {
                                id: $scope.crediteur.id
                            },
                            annonce: {
                                id: $scope.annonce.id
                            },
                            time: 0,
                            note: 0


                        }

                    })
                            .then(function (data) {
                                if (data.status === 201) {
                                    $scope.disable = true;
                                    $scope.ok = true;
                                    $timeout(function () {
                                        $location.path('/');
                                    }, 2000);
                                }
                                else {
                                    $scope.error = true;
                                }
                            });
                };

            }]);

