angular
	.module('delivery.services')
	.factory('Order', OrderService);

OrderService.$inject = ['$resource', 'appConfig'];

function OrderService($resource, appConfig) {
	var url = appConfig.baseUrl + '/api/client/order/:id';
	
	var config = {
		query: {
			isArray: false
		}
	};
	
	var params = {
		id: '@id'
	};
	
	return $resource(url, params, config);
}