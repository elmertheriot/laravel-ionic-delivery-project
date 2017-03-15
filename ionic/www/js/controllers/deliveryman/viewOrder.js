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
	var watch,
		lat = null,
		long = null;
	
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
				if (! lat) {
					lat = position.coords.latitude;
					long = position.coords.longitude;
				} else {
					long -= 0.000444;
				}
				
				var params  = { id: $stateParams.id };
				var content = { 
						lat : lat,
						long: long
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