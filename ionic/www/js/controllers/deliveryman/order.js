angular
	.module('delivery.controllers')
	.controller('DeliverymanOrderController', ClientOrderController);

ClientOrderController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'DeliverymanOrder'
];

function ClientOrderController(
	$scope,
	$state,
	$ionicLoading,
	DeliverymanOrder
) {
	$scope.orders = [];
	
	$ionicLoading.show({
		template: 'Loading...'
	});
	
	loadOrders();
	
	$scope.doRefresh = doRefresh;
	$scope.openOrderDetail = openOrderDetail;
	
	function getOrders() {
		var params = {
			orderBy: 'created_at',
			sortedBy: 'desc'
		};
		
		return DeliverymanOrder.query(params).$promise;
	}
	
	function loadOrders() {
		getOrders().then(success, error);
		
		function success(res) {
			$scope.orders = res.data;
			$ionicLoading.hide();
		}
		
		function error(err) {
			$ionicLoading.hide();
		}
	}
	
	function doRefresh() {
		getOrders().then(success, error);
		
		function success(res) {
			$scope.orders = res.data;
			$scope.$broadcast('scroll.refreshComplete');		}
		
		function error(err) {
			$scope.$broadcast('scroll.refreshComplete');
		}
	}
	
	function openOrderDetail(order) {
		$state.go('deliveryman.view-order', {id: order.id});
	}
}