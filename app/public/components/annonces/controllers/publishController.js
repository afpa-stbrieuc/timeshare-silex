'use strict';

angular.module('TimeShareSilex')
  .controller('publishCtrl', ['$http', function($http, uib) {

	var vm = this;
	vm.sentOK = false;
	vm.sentError = false;
	vm.dt = new Date();
  
	vm.submitAdvert = function(valid) {
		if (valid) {
			vm.advert['user'] = { 'id': '569d06ecc4936293a6f8fd90'};
			vm.advert['demande'] = false;

			$http.post('/api/annonces/', vm.advert).then(
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

	vm.dateOptions = {
		startingDay: 1,
		formatYear: 'yy'
	}

}]);