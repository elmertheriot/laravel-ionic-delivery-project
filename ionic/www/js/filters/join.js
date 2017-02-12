angular
	.module('delivery.filters')
	.filter('join', joinFilter);

function joinFilter() {
	return function (input, joinString) {
		return input.join(joinString);
	}
}