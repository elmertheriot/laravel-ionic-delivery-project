angular
	.module('delivery.controllers')
	.controller('ClientMenuController', ClientMenuController);

ClientMenuController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'User'
];

function ClientMenuController(
	$scope,
	$state,
	$ionicLoading,
	User
) {
	$scope.user = {
		name: ''
	};
	
	$ionicLoading.show({
		template: 'Loading...'
	});
	
	loadAuthenticatedUser();
	
	function loadAuthenticatedUser() {
		User.authenticated(success, error);
		
		function success(res) {
			$scope.user = res.data;
			$ionicLoading.hide();
		}
		
		function error() {
			$ionicLoading.hide();
		}
	}
}