angular
	.module('delivery.controllers')
	.controller('ClientCheckoutDetailController', ClientCheckoutDetailController);

ClientCheckoutDetailController.$inject = [
	'$scope',
	'$state',
	'$stateParams',
	'$cart'
];

function ClientCheckoutDetailController(
	$scope, 
	$state,
	$stateParams,
	$cart
) {
	$scope.product = $cart.getItem($stateParams.index);
	
	$scope.updateQty = updateQty;
	
	function updateQty() {
		$cart.updateQty($stateParams.index, $scope.product.qty);
		$state.go('client.checkout');
	}
}