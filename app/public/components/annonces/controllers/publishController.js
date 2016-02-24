'use strict';

angular.module('TimeShareSilex')
	.controller('publishCtrl', ['$http', '$scope', '$routeParams', '$cookies', function($http, $scope, $routeParams, $cookies) {

		var vm = this;

		vm.dateValiditeDebut = new Date(); // current date
		vm.dateValiditeFin = new Date();
		vm.dateValiditeFin.addMonths(1); // validity of one month by default
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

		if ($routeParams.type === 'advert') {
			vm.isOffer = false;
		} else if ($routeParams.type === 'demand') {
			vm.isOffer = true;
		}

		vm.validateDates = function() {
			var endDate = new Date(vm.dateValiditeFin);
			var startDate = new Date(vm.dateValiditeDebut);
			$scope.advertForm.startDate.$setValidity('endBeforeStart', endDate >= startDate);
		};

		vm.submitAdvert = function(valid) {
			if (valid) {
				vm.advert.user = $cookies.getObject('timeshareCookie');
				vm.advert.demande = vm.isOffer;

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

				$http({
					method: 'POST',
					url: '/api/annonces/',
					data: vm.advert
				}).then(
					function(response) {
						var typeDemande;
						if (vm.isOffer) {
							typeDemande ="offre";
						} else {
							typeDemande ="annonce";
						}
						if (response.status === 201) {
							vm.alert = {
								type: 'success',
								msg: capitalize(typeDemande)+ ' publiée'
							};
							vm.isDisabled = true; // disable submit button
						} else if (response.status === 400) {
							vm.alert = {
								type: 'danger',
								msg: 'Erreur: '+typeDemande+' non publiée'
							};
						} else if (response.status === 404) {
							vm.alert = {
								type: 'danger',
								msg: 'Erreur: '+typeDemande+' non publiée'
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
					typeDemande: 'danger',
					msg: 'Un champ requis est manquant'
				};
			}

		};

		vm.closeAlert = function() {
			vm.alert = {
				typeDemande: '',
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

function capitalize(s) {
    return s && s[0].toUpperCase() + s.slice(1);
}