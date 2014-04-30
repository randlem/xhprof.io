var appServices = angular.module('appServices', ['ngResource']);

appServices.factory('Run', ['$resource',
	function ($resource) {
		console.log('service');
		return $resource('/runs/:runId', {}, {
			query: {
				method: 'GET',
				params: {
					runId: ''
				},
				isArray: true
			}
		});
	}]);