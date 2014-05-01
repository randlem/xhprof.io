var appControllers = angular.module('appControllers', []);

appControllers.controller('RunsListController', ['$scope', 'Run',
	function ($scope, Run) {
		$scope.runs = Run.query();
	}]);

appControllers.controller('RunDetailController', ['$scope', '$routeParams', 'Run',
	function ($scope, $routerParams, Run) {
		$scope.run = Run.get({runId: $routerParams.runId});
	}]);