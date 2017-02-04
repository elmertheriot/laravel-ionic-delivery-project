angular
	.module('delivery.controllers')
	.controller('ClientCheckoutController', ClientCheckoutController);

ClientCheckoutController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'$ionicPopup',
	'$cart',
	'Order'
];

function ClientCheckoutController(
	$scope,
	$state,
	$ionicLoading,
	$ionicPopup,
	$cart,
	Order
) {
	var cart = $cart.get();
		
	$scope.items = cart.items;
	$scope.total = cart.total;
	
	$scope.removeItem  			 = removeItem;
	$scope.openProductDetail = openProductDetail;
	$scope.openListProducts  = openListProducts;
	$scope.saveOrder 				 = saveOrder;
	
	function removeItem(index) {
		$cart.removeItem(index);
		$scope.items.splice(index, 1);
		$scope.total = $cart.get().total;
	}
	
	function openProductDetail(index) {
		$state.go('client.checkout-item-detail', { 
			index: index
		});
	}
	
	function openListProducts() {
		$state.go('client.view-products');
	}
	
	function saveOrder() {
		var items = angular.copy($scope.items);
		
		items.filter(function (item) {
			item.product_id = item.id;
			return item;
		});
		
		$ionicLoading.show({
			template: 'Loading...'
		});
		
		Order.save({ id: null }, { items: items }, success, error);
		
		function success(res) {
			$ionicLoading.hide();
			$state.go('client.checkout-successful');
		}
		
		function error(err) {
			$ionicLoading.hide();
			$ionicPopup.alert({
				title: 'Warning',
				template: 'Problem to save order, please try again.'
			});
		}
	}
}