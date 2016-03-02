
'use strict';

angular.module('TimeShareSilex')
	.controller('editCtrl', ['$http', '$scope', '$routeParams','$window','$location', function($http, $scope, $routeParams,$window,$location) {

		var vm = this;

		vm.minDate = new Date(); // disable use date in the past

		vm.alert = {
			type: '',
			msg: ''
		}; // default altert message for uib-alert

		vm.isDisabled = false; // to later disable submit button

		// uib-datepicker-popup options
		vm.dateOptions = {
			startingDay: 1,
			formatYear: 'yy'
		};

		$http({
			method: 'GET',
			url: '/api/annonces/' + $routeParams.id
		}).then(function(response) {
			if (response.status === 200) {
				vm.advert = response.data;
				vm.dateValiditeDebut = new Date(vm.advert.dateValiditeDebut);
				vm.dateValiditeFin = new Date(vm.advert.dateValiditeFin);
			} else if (response.status === 404) {
				vm.alert = {
					type: 'danger',
					msg: 'Erreur: Annonce non trouvée'
				};
			}
		}, function() {
			vm.alert = {
				type: 'danger',
				msg: 'Erreur serveur'
			};
		});

		vm.validateDates = function() {
			var endDate = new Date(vm.dateValiditeFin);
			var startDate = new Date(vm.dateValiditeDebut);
			$scope.advertForm.startDate.$setValidity('endBeforeStart', endDate >= startDate);
		};

		vm.submitAdvert = function(valid) {
			if (valid) {
				// construct ISO date string from date object
				var d = vm.dateValiditeDebut;
				var day = ('0' + d.getDate()).slice(-2); // force 2 digits
				var month = ('0' + (d.getMonth() + 1)).slice(-2); // force 2 digits
				var year = d.getFullYear();
				vm.advert.dateValiditeDebut = year + '-' + month + '-' + day;

				// construct ISO date string from date object
				var f = vm.dateValiditeFin;
				day = ('0' + f.getDate()).slice(-2); // force 2 digits
				month = ('0' + (f.getMonth() + 1)).slice(-2); // force 2 digits
				year = f.getFullYear();
				vm.advert.dateValiditeFin = year + '-' + month + '-' + day;

				// API expect id and not user object !
				vm.advert.user = vm.advert.user.id;

				$http({
					method: 'PUT',
					url: '/api/annonces/'+vm.advert.id,
					data: vm.advert
				}).then(
					function(response) {
						if (response.status === 200) {
							vm.alert = {
								type: 'success',
								msg: 'Annonce modifée'
							};
							vm.isDisabled = true; // disable submit button
						} else if (response.status === 404) {
							vm.alert = {
								type: 'danger',
								msg: 'Erreur: annonce non modifiée'
							};
						}
					},
					function() {
						vm.alert = {
							type: 'danger',
							msg: 'Erreur serveur'
						};
					});
			} else {
				vm.alert = {
					type: 'danger',
					msg: 'Un champ requis est manquant'
				};
			}

		};
                
                
                vm.delete = function () {

                    vm.deleteUser = $window.confirm('Etes vous sur de vouloir supprimer votre annonce?');
                    if (vm.deleteUser) {

                        $http({
                            method: 'DELETE',
                            url: '/api/annonces/' + $routeParams.id
                        }).then(function (response) {
                            if (response.status === 200) {
                                $location.path('/user');
                            }
                            else {
                                vm.alert = {
                                    type: 'danger',
                                    msg: 'Erreur: annonce non modifiée'
                                };

                            }
                        });
                    }
                };

		vm.closeAlert = function() {
			vm.alert = {
				type: '',
				msg: ''
			};
		};

	}]);


// taken from datejs library to be able to add a month
Date.isLeapYear = function(year) {
	return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
};

Date.getDaysInMonth = function(year, month) {
	return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
};

Date.prototype.isLeapYear = function() {
	return Date.isLeapYear(this.getFullYear());
};

Date.prototype.getDaysInMonth = function() {
	return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
};

Date.prototype.addMonths = function(value) {
	var n = this.getDate();
	this.setDate(1);
	this.setMonth(this.getMonth() + value);
	this.setDate(Math.min(n, this.getDaysInMonth()));
	return this;
};