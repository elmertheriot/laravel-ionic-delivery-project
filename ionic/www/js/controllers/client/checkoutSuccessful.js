angular
	.module('delivery.controllers')
	.controller('ClientCheckoutSuccessfulController', ClientCheckoutSuccessfulController);

ClientCheckoutSuccessfulController.$inject = [
	'$scope',
	'$state',
	'$cart'
];

function ClientCheckoutSuccessfulController(
	$scope, 
	$state,
	$cart
) {
	var cart = $cart.get();
	$scope.items = cart.items;
	$scope.total = cart.total;
	$cart.clear();
	
	$scope.openOrderList = openOrderList;
	
	function openOrderList() {
		
	}
}