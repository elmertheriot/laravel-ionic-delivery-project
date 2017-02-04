angular
	.module('delivery.controllers')
	.controller('ClientViewProductsController', ClientViewProductsController);

ClientViewProductsController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'$localStorage',
	'$cart',
	'Product'
];

function ClientViewProductsController(
	$scope, 
	$state,
	$ionicLoading,
	$localStorage,
	$cart,
	Product
) {
	$scope.products = [];
	
	$scope.addItem = addItem;
	
	$ionicLoading.show({
		template: 'Loading...'
	});
	
	function loadProducts() {
		Product.query(success, error);
		
		function success(res) {
			$scope.products = res.data;
			$ionicLoading.hide();
		}
		
		function error(err) {
			$ionicLoading.hide();
		}
	}
	
	function addItem(product) {
		product.qty = 1;
		$cart.addItem(product);
		$state.go('client.checkout');
	}
	
	loadProducts();
}