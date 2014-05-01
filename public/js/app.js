var app = angular.module('XhprofIoApp', [
	'ngRoute',
	'ngResource',
	'appFilters',
	'appServices',
	'appControllers'
]);

app.config(['$routeProvider',
	function ($routeProvider) {
		$routeProvider.
			when('/runs', {
				templateUrl: 'partials/runs-list.html',
				controller: 'RunsListController'
			}).
			when('/runs/:runId', {
				templateUrl: 'partials/run-detail.html',
				controller: 'RunDetailController'
			}).
			otherwise({
				redirectTo: '/runs'
			})

	}
]);