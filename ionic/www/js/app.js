// Ionic Starter App
angular.module('delivery.controllers', []);
angular.module('delivery.services', []);

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('delivery', [
	'ionic',
	'delivery.controllers',
	'delivery.services',
	'angular-oauth2',
	'ngResource'
])

.constant('appConfig', {
	baseUrl: 'http://localhost:8000'
})

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

.config(function (
		$stateProvider, 
		$urlRouterProvider, 
		$provide, 
		OAuthProvider, 
		OAuthTokenProvider, 
		appConfig
) {
	OAuthProvider.configure({
    baseUrl: appConfig.baseUrl,
    clientId: 'appid01',
    clientSecret: 'secret', // optional
    grantPath: '/oauth/access_token'
  });
	
	OAuthTokenProvider.configure({
	  name: 'token',
	  options: {
	    secure: false
	  }
	});
	
	$stateProvider
		.state('login', {
			url: '/login',
			templateUrl: 'templates/login.html',
			controller: 'LoginController'
		})
		.state('home', {
			url: '/home',
			templateUrl: 'templates/home.html',
			controller: function ($scope) {
				
			}
		})
		.state('client', {
			abstract: true,
			url: '/client',
			template: '<ion-nav-view/>'
		})
		.state('client.checkout', {
			cache: false,
			url: '/checkout',
			templateUrl: 'templates/client/checkout.html',
			controller: 'ClientCheckoutController'
		})
		.state('client.checkout-item-detail', {
			url: '/checkout/detail/:index',
			templateUrl: 'templates/client/checkout-item-detail.html',
			controller: 'ClientCheckoutDetailController'
		})
		.state('client.checkout-successful', {
			cache: false,
			url: '/checkout/successful',
			templateUrl: 'templates/client/checkout-successful.html',
			controller: 'ClientCheckoutSuccessfulController'
		})
		.state('client.view-products', {
			url: '/view-products',
			templateUrl: 'templates/client/view-products.html',
			controller: 'ClientViewProductsController'
		});
	
		$urlRouterProvider.otherwise('/login');
		
		$provide.decorator('OAuthToken', OAuthTokenLocalStorageDecorator);
		
		OAuthTokenLocalStorageDecorator.$inject = ['$localStorage', '$delegate'];
		
		function OAuthTokenLocalStorageDecorator($localStorage, $delegate) {
			Object.defineProperties($delegate, {
				setToken: {
					value: function (data) {
						return $localStorage.setObject('token', data);
					},
					enumerable: true,
					configurable: true,
					writable: true
				},
				getToken: {
					value: function () {
						return $localStorage.getObject('token');
					},
					enumerable: true,
					configurable: true,
					writable: true
				},
				removeToken: {
					value: function () {
						$localStorage.setObject('token', null);
					},
					enumerable: true,
					configurable: true,
					writable: true
				}
			});
			return $delegate;
		}
});