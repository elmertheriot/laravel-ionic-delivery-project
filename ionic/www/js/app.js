// Ionic Starter App
angular.module('delivery.controllers', []);
angular.module('delivery.services', []);
angular.module('delivery.filters', []);

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('delivery', [
	'ionic',
	'ionic.service.core',
	'delivery.controllers',
	'delivery.services',
	'delivery.filters',
	'angular-oauth2',
	'ngResource',
	'ngCordova',
	'uiGmapgoogle-maps',
	'pusher-angular'
])

.constant('appConfig', {
	baseUrl: 'http://0.0.0.0:8000',
	pusherKey: 'f9f3915924c427028eda'
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
			cache: false,
			url: '/client',
			templateUrl: 'templates/client/menu.html',
			controller: 'ClientMenuController'
		})
		.state('client.order', {
			url: '/order',
			templateUrl: 'templates/client/order.html',
			controller: 'ClientOrderController'
		})
		.state('client.view-order', {
			url: '/view-order/:id',
			templateUrl: 'templates/client/view-order.html',
			controller: 'ClientViewOrderController'
		})
		.state('client.view-delivery', {
			cache: false,
			url: '/view-delivery/:id',
			templateUrl: 'templates/client/view-delivery.html',
			controller: 'ClientViewDeliveryController'
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
		})
		.state('deliveryman', {
			abstract: true,
			cache: false,
			url: '/deliveryman',
			templateUrl: 'templates/deliveryman/menu.html',
			controller: 'DeliverymanMenuController'
		})
		.state('deliveryman.order', {
			url: '/order',
			templateUrl: 'templates/deliveryman/order.html',
			controller: 'DeliverymanOrderController'
		})
		.state('deliveryman.view-order', {
			cache: false,
			url: '/view-order/:id',
			templateUrl: 'templates/deliveryman/view-order.html',
			controller: 'DeliverymanViewOrderController'
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
})

.run(function($ionicPlatform, $window, $localStorage, appConfig) {
	$window.client = new Pusher(appConfig.pusherKey);

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

    Ionic.io();
    var push = new Ionic.Push({
    	debug: true,
    	onNotification: function (message) {
    		alert(message.text);
    	},
    	pluginCOnfig: {
    		android: {
    			iconColor: "red"
    		}
    	}
    });
    push.register(function (t) {
    	$localStorage.set("device_token", t.token);
    });
  });
});
