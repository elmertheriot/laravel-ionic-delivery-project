angular
	.module('delivery.controllers')
	.controller('LoginController', LoginController);

LoginController.$inject = [
	'$scope',
	'OAuth',
	'$ionicPopup',
	'$state'
];

function LoginController(
	$scope, 
	OAuth, 
	$ionicPopup,
	$state
) {
	$scope.user = {
		username: '',
		password: ''
	};
	
	$scope.login = login;
	
	function login() {
		OAuth.getAccessToken($scope.user).then(success, error);
		
		function success(res) {
			$state.go('client.checkout');
		}
		
		function error(err) {
			$ionicPopup.alert({
				title: 'Warning',
				template: 'Invalid username or password'
			});
		}
	}
}