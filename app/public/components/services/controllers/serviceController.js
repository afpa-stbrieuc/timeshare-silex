'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
        .controller('serviceCtrl', function ($scope, $http, $routeParams) {

            // call a fake user (testing)
            $http({
                method: 'GET',
                url: '/api/user/56c43fbf2ca65eb80d00002b'
            }).then(function(response){
                $scope.crediteur = response.data;
            }, function(response) {
                $scope.crediteur = response.statusText;
            });
            
            //get the advert id
            $http({
                method: 'GET',
                url: '/api/annonces/' + $routeParams.id
            }).then(function (response) {
                $scope.annonce = response.data;
            }, function (response) {
                $scope.annonce = response.statusText;
            });
            
            $scope.createService = function(){               
                
                $http({
                    method: 'POST',
                    url: '/api/services/',
                    data: {
                        
                        crediteur :{
                           id : $scope.crediteur.id
                        },
                        annonce : {
                            id : $scope.annonce.id
                        },
                        time : 0,
                        note : 0
                        
                        
                    }
                });             
            };

        });

