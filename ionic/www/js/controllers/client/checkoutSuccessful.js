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
	$scope.coupon = cart.coupon;
	$scope.items  = cart.items;
	$scope.total  = $cart.getTotalWithDiscount();
	$cart.clear();
	
	$scope.openOrderList = openOrderList;
	
	function openOrderList() {
		$state.go('client.order');
	}
}