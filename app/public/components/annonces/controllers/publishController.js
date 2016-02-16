'use strict';

angular.module('TimeShareSilex')
  .controller('publishCtrl', function($http) {

	var vm = this;
	vm.sentOK = false;
	vm.sentError = false;
  
	vm.submitAdvert = function(valid) {
		if (valid) {
			var data = {
				'name': vm.advert.name,
				'user': { 'id': '569d06ecc4936293a6f8fd90'},
				'location': vm.advert.location,
				'category': vm.advert.category,
				'dateValiditeDebut': vm.advert.dateValiditeDebut,
				'dateValiditeFin': vm.advert.dateValiditeFin,
				'demande': false
			};

			$http.post('/api/annonces/', data).then(
				function (response) {
					if (response.status === 201) {
						vm.sentOK = true;
					}
				},
				function () {
					vm.sentError = true;
				});
		}

	};

});