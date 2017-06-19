angular
	.module('delivery.services')
	.factory('User', UserService);

UserService.$inject = ['$resource', 'appConfig'];

function UserService($resource, appConfig) {
	var url = appConfig.baseUrl + '/api/authenticated';

	var params = {};

	var config = {
		query: {
			isArray: false
		},
		authenticated: {
			method: 'GET',
			url: appConfig.baseUrl + '/api/authenticated'
		},
		updateDeviceToken: {
			method: 'PATCH',
			url: appConfig.baseUrl + '/api/device_token'
		}
	};

	return $resource(url, params, config);
}
