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
	};
});

appFilters.filter('formatTiming', function () {
	return function (timing) {
		if (timing >= 1000000) {
			return (timing / 1000000).toFixed(3) + 's';
		} else if (timing >= 1000) {
			return (timing / 1000).toFixed(3) + 'ms';
		} else {
			return timing.toString() + '\u00B5s';
		}
	};
});

appFilters.filter('formatMemory', function () {
	return function (memory) {
		var bins = ['B','K','M','G'];

		for (var i=bins.length-1; i >= 0; i--) {
			var cutoff = Math.pow(1024, i);
			if (memory > cutoff) {
				var val = memory / cutoff;
				console.log(val);
				return ((val % 1 === 0) ? val : val.toFixed(2)) + bins[i];
			}
		}

		return memory;
	};
});