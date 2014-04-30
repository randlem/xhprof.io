var appServices = angular.module('appServices', ['ngResource']);

appServices.factory('Run', ['$resource',
	function ($resource) {
		return $resource('/runs/:runId.json', {}, {
			query: {
				method: 'GET',
				params: {
					runId: 'runs'
				},
				isArray: true
			}
		});
	}]);