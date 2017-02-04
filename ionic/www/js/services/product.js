angular
	.module('delivery.services')
	.factory('Product', ProductService);

ProductService.$inject = ['$resource', 'appConfig'];

function ProductService($resource, appConfig) {
	var url = appConfig.baseUrl + '/api/client/products';
	
	var config = {
		query: {
			isArray: false
		}
	};
	
	var params = {};
	
	return $resource(url, params, config);
}