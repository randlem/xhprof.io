var appControllers = angular.module('appControllers', []);

appControllers.controller('RunsListController', ['$scope', 'Run',
	function ($scope, Run) {
		$scope.runs = Run.query();
	}]);