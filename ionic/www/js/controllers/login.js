angular
	.module('delivery.controllers')
	.controller('LoginController', LoginController);

LoginController.$inject = [
	'$scope',
	'OAuth',
	'OAuthToken',
	'$ionicPopup',
	'$state',
	'UserData',
	'User',
];

function LoginController(
	$scope, 
	OAuth, 
	OAuthToken,
	$ionicPopup,
	$state,
	UserData,
	User
) {
	$scope.user = {
		username: '',
		password: ''
	};
	
	$scope.login = login;
	
	function login() {
		var promise = OAuth.getAccessToken($scope.user);
		
		promise
			.then(successLogin)
			.then(successUser, error);
		
		function successLogin(res) {
			return User.authenticated({ include: 'client' }).$promise;
		}
		
		function successUser(res) {
			UserData.set(res.data);
			$state.go('client.checkout');
		}
		
		function error(err) {
			UserData.set(null);
			OAuthToken.removeToken();
			$ionicPopup.alert({
				title: 'Warning',
				template: 'Invalid username or password'
			});
		}
	}
}