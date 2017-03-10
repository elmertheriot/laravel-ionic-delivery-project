angular
	.module('delivery.controllers')
	.controller('DeliverymanViewOrderController', ClientViewOrderController);

ClientViewOrderController.$inject = [
	'$scope',
	'$stateParams',
	'$ionicLoading',
	'DeliverymanOrder'
];

function ClientViewOrderController(
	$scope, 
	$stateParams,
	$ionicLoading,
	DeliverymanOrder
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
		
		DeliverymanOrder.get(params, success, error);
		
		function success(res) {
			$scope.order = res;
			$ionicLoading.hide();
		}
		
		function error(err) {
			$ionicLoading.hide();
		}
	}
}