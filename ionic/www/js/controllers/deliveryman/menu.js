angular
	.module('delivery.controllers')
	.controller('DeliverymanMenuController', ClientMenuController);

ClientMenuController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'UserData'
];

function ClientMenuController(
	$scope,
	$state,
	$ionicLoading,
	UserData
) {
	$scope.user = UserData.get();
}