var appFilters = angular.module('appFilters', []);

appFilters.filter('shortenId', function() {
	return function (id) {
		return id.substring(0,7);
	};
});

appFilters.filter('shortenUri', function () {
	var maxlen = 40;
	return function (uri) {
		if (uri.length <= maxlen) {
			return uri;
		}
		return '\u2026' + uri.substring(uri.length, uri.length - maxlen - 1);
	};
});

appFilters.filter('formatTime', function () {
	return function (raw) {
		var ts = moment.unix(raw);
		return ts.format('YYYY-MM-DD HH:mm:ss');
	}
});