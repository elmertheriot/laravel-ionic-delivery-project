angular
	.module('delivery.controllers')
	.controller('ClientOrderController', ClientOrderController);

ClientOrderController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'Order'
];

function ClientOrderController(
	$scope,
	$state,
	$ionicLoading,
	Order
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
		
		return Order.query(params).$promise;
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
		$state.go('client.view-order', {id: order.id});
	}
}