angular
	.module('delivery.controllers')
	.controller('LoginController', LoginController);

LoginController.$inject = [
	'$scope',
	'OAuth',
	'OAuthToken',
	'$ionicPopup',
	'$state',
	'$localStorage',
	'UserData',
	'User',
];

function LoginController(
	$scope,
	OAuth,
	OAuthToken,
	$ionicPopup,
	$state,
	$localStorage,
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
			.then()
			.then(successLogin)
			.then(successUser, error);

		function updateDeviceToken(res) {
			var token = $localStorage.get('device_token');
			return User.updateDeviceToken({}, { device_token: token }).$promise;
		}

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
