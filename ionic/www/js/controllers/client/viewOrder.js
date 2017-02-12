angular
	.module('delivery.controllers')
	.controller('ClientViewOrderController', ClientViewOrderController);

ClientViewOrderController.$inject = [
	'$scope',
	'$stateParams',
	'$ionicLoading',
	'Order'
];

function ClientViewOrderController(
	$scope, 
	$stateParams,
	$ionicLoading,
	Order
) {
	$scope.order = {};
	
	$ionicLoading.show({
		template: 'Loading...'
	});
	
	loadOrder();
	
	function loadOrder() {
		var params = {
			id: $stateParams.id,
			include: 'items,coupon'
		};
		
		Order.get(params, success, error);
		
		function success(res) {
			$scope.order = res.data;
			$ionicLoading.hide();
		}
		
		function error(err) {
			$ionicLoading.hide();
		}
	}
}