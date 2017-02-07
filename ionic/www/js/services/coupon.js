angular
	.module('delivery.services')
	.factory('Coupon', CouponService);

CouponService.$inject = ['$resource', 'appConfig'];

function CouponService($resource, appConfig) {
	var url = appConfig.baseUrl + '/api/coupon/:code';
	
	var params = {
		code: '@code'
	};
	
	var options = {
		query: {
			isArray: false
		}
	};
	
	return $resource(url, params, options);
}