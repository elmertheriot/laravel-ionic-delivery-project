angular
	.module('delivery.services')
	.factory('ClientOrder', ClientOrderService)
	.factory('DeliverymanOrder', DeliverymanOrderService);

ClientOrderService.$inject = ['$resource', 'appConfig'];

function ClientOrderService($resource, appConfig) {
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

DeliverymanOrderService.$inject = ['$resource', 'appConfig'];

function DeliverymanOrderService($resource, appConfig) {
	var url = appConfig.baseUrl + '/api/deliveryman/order/:id';
	
	var config = {
		query: {
			isArray: false
		},
		updateStatus: {
			method: 'PATCH',
			url: url + '/update-status'
		},
		geo: {
			method: 'POST',
			url: url + '/geo'
		}
	};
	
	var params = {
		id: '@id'
	};
	
	return $resource(url, params, config);
}