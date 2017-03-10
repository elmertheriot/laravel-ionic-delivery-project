angular
	.module('delivery.controllers')
	.controller('ClientCheckoutController', ClientCheckoutController);

ClientCheckoutController.$inject = [
	'$scope',
	'$state',
	'$ionicLoading',
	'$ionicPopup',
	'$cordovaBarcodeScanner',
	'$cart',
	'ClientOrder',
	'Coupon'
];

function ClientCheckoutController(
	$scope,
	$state,
	$ionicLoading,
	$ionicPopup,
	$cordovaBarcodeScanner,
	$cart,
	ClientOrder,
	Coupon
) {
	var cart = $cart.get();
	
	$scope.coupon = cart.coupon;	
	$scope.items  = cart.items;
	$scope.total  = $cart.getTotalWithDiscount();
	
	$scope.removeItem  			 = removeItem;
	$scope.openProductDetail = openProductDetail;
	$scope.openListProducts  = openListProducts;
	$scope.saveOrder 				 = saveOrder;
	$scope.readBarCode			 = readBarCode;
	$scope.removeCoupon      = removeCoupon; 
	
	function removeItem(index) {
		$cart.removeItem(index);
		$scope.items.splice(index, 1);
		$scope.total = $cart.getTotalWithDiscount();
	}
	
	function openProductDetail(index) {
		$state.go('client.checkout-item-detail', { 
			index: index
		});
	}
	
	function openListProducts() {
		$state.go('client.view-products');
	}
	
	function saveOrder() {
		var order = {
				items: angular.copy($scope.items)
		};
		
		order.items.filter(function (item) {
			item.product_id = item.id;
			return item;
		});
		
		$ionicLoading.show({
			template: 'Loading...'
		});
		
		if ($scope.coupon.value) {
			order.coupon_code = $scope.coupon.code;
		}
		
		ClientOrder.save({ id: null }, order, success, error);
		
		function success(res) {
			$ionicLoading.hide();
			$state.go('client.checkout-successful');
		}
		
		function error(err) {
			$ionicLoading.hide();
			$ionicPopup.alert({
				title: 'Warning',
				template: 'Problem to save order, please try again.'
			});
		}
	}
	
	function readBarCode() {
		$cordovaBarcodeScanner
	    .scan()
	    .then(function(barcodeData) {
	    	getValueCoupon(barcodeData.text);
	    }, function(error) {
	    	$ionicPopup.alert({
					title: 'Warning',
					template: 'It was not possible to read barcode.'
				});
	    });
	}
	
	function removeCoupon() {
		$cart.removeCoupon();
		
		$scope.coupon = $cart.get().coupon;
		$scope.total  = $cart.getTotalWithDiscount();
	}
	
	function getValueCoupon(code) {
		$ionicLoading.show({
			template: 'Loading...'
		});
		
		Coupon.get({code: code}, success, error);
		
		function success(res) {
			$cart.setCoupon(res.data.code, res.data.value);
			
			$scope.coupon = $cart.get().coupon;
			$scope.total  = $cart.getTotalWithDiscount();
			
			$ionicLoading.hide();
		}
		
		function error(err) {
			$ionicLoading.hide();
			$ionicPopup.alert({
				title: 'Warning',
				template: 'Invalid coupon.'
			});
		}
	}
}