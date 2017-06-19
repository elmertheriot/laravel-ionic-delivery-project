angular
	.module('delivery.controllers')
	.controller('ClientOrderController', ClientOrderController);

ClientOrderController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'$ionicActionSheet',
	'ClientOrder'
];

function ClientOrderController(
	$scope,
	$state,
	$ionicLoading,
	$ionicActionSheet,
	ClientOrder
) {
	$scope.orders = [];

	$ionicLoading.show({
		template: 'Loading...'
	});

	loadOrders();

	$scope.doRefresh = doRefresh;
	$scope.openOrderDetail = openOrderDetail;
	$scope.showActionSheet = showActionSheet;

	function getOrders() {
		var params = {
			orderBy: 'created_at',
			sortedBy: 'desc'
		};

		return ClientOrder.query(params).$promise;
	}

	function loadOrders() {
		getOrders().then(success, error);

		function success(res) {
			$scope.orders = res.data;
			$ionicLoading.hide();
		}

		function error(err) {
			$ionicLoading.hide();
		}
	}

	function doRefresh() {
		getOrders().then(success, error);

		function success(res) {
			$scope.orders = res.data;
			$scope.$broadcast('scroll.refreshComplete');
		}

		function error(err) {
			$scope.$broadcast('scroll.refreshComplete');
		}
	}

	function openOrderDetail(order) {
		$state.go('client.view-order', {id: order.id});
	}

	function showActionSheet(order) {
		$ionicActionSheet.show({
			buttons: [
			  { text: 'See details' },
			  { text: 'See delivery' },
			],
			titleText: 'Select an option:',
			cancelText: 'Cancel',
			cancel: function () {
				// to something
			},
			buttonClicked: function (index) {
				switch (index) {
					case 0:
						$state.go('client.view-order', { id: order.id })
						break;
					case 1:
						$state.go('client.view-delivery', { id: order.id })
						break;
				}
			}
		});
	}
}
