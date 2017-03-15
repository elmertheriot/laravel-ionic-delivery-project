angular
	.module('delivery.controllers')
	.controller('DeliverymanViewOrderController', ClientViewOrderController);

ClientViewOrderController.$inject = [
	'$scope',
	'$stateParams',
	'$ionicLoading',
	'$ionicPopup',
	'$cordovaGeolocation',
	'DeliverymanOrder'
];

function ClientViewOrderController(
	$scope, 
	$stateParams,
	$ionicLoading,
	$ionicPopup,
	$cordovaGeolocation,
	DeliverymanOrder
) {
	var watch;
	
	$scope.order = {};
	$scope.goToDelivery = goToDelivery;
	
	$ionicLoading.show({
		template: 'Loading...'
	});
	
	loadOrder();
	
	function loadOrder() {
		var params = {
			id: $stateParams.id,
			include: 'items,coupon'
		};
		
		DeliverymanOrder.get(params, success, error);
		
		function success(res) {
			$scope.order = res.data;
			$ionicLoading.hide();
		}
		
		function error(err) {
			$ionicLoading.hide();
		}
	}
	
	function goToDelivery() {
		$ionicPopup.alert({
			title: 'Attention',
			template: 'The app is showing your location to the client, to stop press OK.'
		}).then(stopWatchPosition);

		var params  = { id: $stateParams.id };
		var content = { status: 1 };
		DeliverymanOrder.updateStatus(params, content, success);
		
		function success(res) {
			var watchOptions = {
				timeout: 3000,
				enableHighAccuracy: false
			};
			
			watch = $cordovaGeolocation.watchPosition(watchOptions);
			watch.then(null, errorWatch, notify);
			
			function errorWatch(err) {
				// errors
			}
			
			function notify(position) {
				var params  = { id: $stateParams.id };
				var content = { 
						lat : position.coords.latitude,
						long: position.coords.longitude
				};
				DeliverymanOrder.geo(params, content);
			}
		}
	}
	
	function stopWatchPosition() {
		if (watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')) {
			$cordovaGeolocation.clearWatch(watch.watchID);
		}
	}
}