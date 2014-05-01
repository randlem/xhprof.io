var appServices = angular.module('appServices', ['ngResource']);

appServices.factory('Run', ['$resource',
	function ($resource) {
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