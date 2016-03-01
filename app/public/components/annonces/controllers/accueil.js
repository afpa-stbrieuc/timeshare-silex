'use strict';
//doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
angular.module('TimeShareSilex')
        .controller('accueilCtrl', function ($scope, $http) {

            $scope.noAdvert = false;
            $scope.advert = false;
            $scope.demande = false;
            $scope.offer = false;

            $scope.categories = [
                'Jardinage',
                'Mécanique',
                'Construction',
                'Bricolage',
                'Transport',
                'Cours'
            ];

            $scope.locations = [
                'Hennebont',
                'Paris',
                'Tregastel',
                'Saint-Brieuc',
                'Brest'
            ];



//    //get all categories
//    $http({
//        method : 'GET',
//        url : '/api/categorie'
//      }).then(function (response){
//        $scope.categories = response.data;
//      },function(response){
//        $scope.categories = response.statusText;
//      });

//            //get all location    
//            $http({
//                method: 'GET',
//                url: '/api/location'
//            }).then(function (response) {
//                $scope.locations = response.data;
//            }, function (response) {
//                $scope.locations = response.statusText;
//            });



// show the annonces depending their categories and locations
            $scope.showannonces = function () {

                //pagination
                var refresh = function () {
                    $scope.totalItems = $scope.annonces.length;
                    $scope.currentPage = 1;
                    $scope.itemsPerPage = 5;
                    $scope.maxSize = 5;
                };
                //show all adverts when search wiht empty criteria
                if (($scope.myCategory === undefined) && ($scope.myLocation === undefined)) {
                    $http({
                        method: 'GET',
                        url: '/api/annonces'
                    }).then(function (response) {
                        $scope.annonces = response.data;
                        $scope.advert = true;
                        $scope.demande = true;
                        $scope.offer = false;
                        refresh();
                    }, function (response) {
                        $scope.annonces = response.statusText;
                    });
                } else {
                    //show adverts with selected categories and locations criteria  
                    $http({
                        method: 'GET',
                        url: '/api/annonces/' + $scope.myCategory + '/' + $scope.myLocation
                    }).then(function (response) {
                        $scope.annonces = response.data;
                        if ($scope.annonces.length === 0) {
                            $scope.noAdvert = true;
                            $scope.advert = false;
                            $scope.offer = false;

                        }
                        else {

                            $scope.noAdvert = false;
                            $scope.advert = true;
                            $scope.demande = true;
                            $scope.offer = false;
                            refresh();
                        }

                    }, function (response) {
                        $scope.annonces = response.statusText;
                    });
                }

            };

            $scope.showoffers = function () {
                //pagination
                var refresh = function () {
                    $scope.totalItems = $scope.offres.length;
                    $scope.currentPage = 1;
                    $scope.itemsPerPage = 5;
                    $scope.maxSize = 5;
                };
                //show all adverts when search wiht empty criteria
                if (($scope.myCategory === undefined) && ($scope.myLocation === undefined)) {
                    $http({
                        method: 'GET',
                        url: '/api/offre'
                    }).then(function (response) {
                        $scope.offres = response.data;
                        $scope.advert = true;
                        $scope.demande = false;
                        $scope.offer = true;
                        refresh();
                    }, function (response) {
                        $scope.offres = response.statusText;
                    });
                } else {
                    //show adverts with selected categories and locations criteria  
                    $http({
                        method: 'GET',
                        url: '/api/offre/' + $scope.myCategory + '/' + $scope.myLocation
                    }).then(function (response) {
                        $scope.offres = response.data;
                        if ($scope.offres.length === 0) {
                            $scope.noAdvert = true;
                            $scope.advert = false;
                            $scope.demande = false;
                        }
                        else {

                            $scope.noAdvert = false;
                            $scope.advert = true;
                            $scope.demande = false;
                            $scope.offer = true;
                            refresh();
                        }

                    }, function (response) {
                        $scope.offres = response.statusText;
                    });
                }

            }
        });

