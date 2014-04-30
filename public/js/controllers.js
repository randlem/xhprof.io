var app = angular.module('XhprofIoApp', []);

app.controller('RunsListController', ['$scope', 'Run',
	function ($scope, Run) {
		$scope.runs = Run.query();
	}]);