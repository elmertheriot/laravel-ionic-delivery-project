angular
	.module('delivery.controllers')
	.controller('ClientViewDeliveryController', ClientViewDeliveryController)
	.controller('CvdControlDescentralize', CvdControlDescentralize)
	.controller('CvdControlReload', CvdControlReload);

ClientViewDeliveryController.$inject = [
	'$scope',
	'$stateParams',
	'$ionicLoading',
	'$ionicPopup',
	'$pusher',
	'$window',
	'$map',
	'uiGmapGoogleMapApi',
	'ClientOrder',
	'UserData'
];

function ClientViewDeliveryController(
	$scope, 
	$stateParams,
	$ionicLoading,
	$ionicPopup,
	$pusher,
	$window,
	$map,
	uiGmapGoogleMapApi,
	ClientOrder,
	UserData
) {
	var iconUrl = 'http://maps.google.com/mapfiles/kml/pal2';
	
	$scope.order = {};
	$scope.map = $map;
	$scope.markers = [];
	
	$ionicLoading.show({
		template: 'Loading...'
	});
	
	uiGmapGoogleMapApi.then(function () {
		$ionicLoading.hide();
	}, function () {
		$ionicLoading.hide();
	});
	
	loadOrder();
	
	function loadOrder() {
		var params = {
			id: $stateParams.id,
			include: 'items,coupon'
		};
		
		ClientOrder.get(params, success, error);
		
		function success(res) {
			$scope.order = res.data;
			if ($scope.order.status == 1) {
				initMarkers($scope.order);
			} else {
				$ionicPopup.alert({
					title: 'Attention!',
					template: 'Order is not being delivered'
				});
			}
		}
		
		function error(err) {
			$ionicLoading.hide();
		}
	}
	
	function initMarkers(order) {
		var client = UserData.get().client.data,
			address = client.zipcode + ', ' 
				+ client.address + ', ' 
				+ client.city + ' - '
				+ client.state;
		
		createMarkerClient(address);
		watchPositionDeliveryman(order.hash);
	}
	
	function createMarkerClient(address) {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			address: address
		}, function (res, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var lat = res[0].geometry.location.lat(),
					long = res[0].geometry.location.lng();
				
				$scope.markers.push({
					id: 'client',
					coords: {
						latitude: lat,
						longitude: long
					},
					options: {
						title: 'Delivery local',
						icon: iconUrl + '/icon2.png'
					}
				});
			} else {
				$ionicPopup.alert({
					title: 'Attention!',
					template: 'It was not possible to find your address :('
				});
			}
		});
	}
	
	function watchPositionDeliveryman(channel) {
		var pusher = $pusher($window.client),
			channel = pusher.subscribe(channel);
		
		channel.bind('DOLucasDelivery\\\Events\\GetLocationDeliveryman', function (res) {
			var lat = res.geo.lat,
				long = res.geo.long;
			
			if ($scope.markers.length == 1 || $scope.markers.length == 0) {
				$scope.markers.push({
					id: 'deliveryman',
					coords: {
						latitude: lat,
						longitude: long
					},
					options: {
						title: 'Deliveryman',
						icon: iconUrl + '/icon47.png'
					}
				});
				return;
			}
			
			for (var key in $scope.markers) {
				if ($scope.markers[key].id == 'deliveryman') {
					$scope.markers[key].coords = {
						latitude: lat,
						longitude: long
					};
				}
			}
		});
	}
	
	function createBounds() {
		var bounds = new google.maps.LatLngBounds(),
			latlng;
		
		angular.forEach($scope.markers, function (value) {
			latlng = new google.maps.LatLng(Number(value.coords.latitude), Number(value.coords.longitude));
			bounds.extend(latlng);
			$scope.map.bounds = {
				northeast: {
					latitude: bounds.getNorthEast().lat(),
					longitude: bounds.getNorthEast().lng()
				},
				southwest: {
					latitude: bounds.getSouthWest().lat(),
					longitude: bounds.getSouthWest().lng()
				}
			};
		});
	}
	
	$scope.$watch('markers.length', function (value) {
		if (value == 2) {
			createBounds();
		}
	});
}

CvdControlDescentralize.$inject = ['$scope', '$map'];

function CvdControlDescentralize($scope, $map) {
	$scope.map = $map,
	$scope.fit = function () {
		$scope.map.fit = !$scope.map.fit;
	};
}

CvdControlReload.$inject = ['$scope', '$window', '$timeout'];

function CvdControlReload($scope, $window, $timeout) {
	$scope.reload = function () {
		$timeout(function () {
			$window.location.reload(true);
		}, 100);
	};
}