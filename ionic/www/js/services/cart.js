angular
	.module('delivery.services')
	.service('$cart', CartService);

CartService.$inject = ['$localStorage'];

function CartService($localStorage) {
	var key = 'cart',
		cartNotExists = !$localStorage.getObject(key);
	
	if (cartNotExists) {
		initCart();
	}
	
	this.clear = function () {
		initCart();
	};
	
	this.get = function () {
		return $localStorage.getObject(key);
	};
	
	this.getItem = function (index) {
		return this.get().items[index];
	};
	
	this.addItem = function (item) {
		var cart 	   = this.get(),
			itemAux		 = null,
		 	itemExists = false;
		
		for (var index in cart.items) {
			itemAux = cart.items[index];
			if (itemAux.id === item.id) {
				itemAux.qty += item.qty;
				itemAux.subTotal = calculateSubTotal(itemAux);
				itemExists = true;
				break;
			}
		}
		
		if (! itemExists) {
			item.subTotal = calculateSubTotal(item);
			cart.items.push(item);
		}
		
		cart.total = getTotal(cart.items);
		
		$localStorage.setObject(key, cart);
	};
	
	this.removeItem = function (index) {
		var cart = this.get();
		cart.items.splice(index, 1);
		cart.total = getTotal(cart.items);
		
		$localStorage.setObject(key, cart);
	};
	
	this.updateQty = function (index, qty) {
		var cart = this.get(),
			itemAux = cart.items[index];
		
		itemAux.qty = qty;
		itemAux.subTotal = calculateSubTotal(itemAux);
		cart.total = getTotal(cart.items);
		
		$localStorage.setObject(key, cart);
	};
	
	this.setCoupon = function (code, value) {
		var cart = this.get();
		cart.coupon = {
			code: code,
			value: value
		};
		$localStorage.setObject(key, cart);
	};
	
	this.removeCoupon = function () {
		var cart = this.get();
		cart.coupon = {
			code: null,
			value: null
		};
		$localStorage.setObject(key, cart);
	};
	
	this.getTotalWithDiscount = function () {
		var cart = this.get();
		return cart.total - (cart.coupon.value || 0);
	};
	
	function calculateSubTotal(item) {
		return item.price * item.qty;
	}
	
	function getTotal(items) {
		var sum = 0;
		angular.forEach(items, function (item) {
			sum += item.subTotal;
		});
		return sum;
	}
	
	function initCart() {
		$localStorage.setObject(key, {
			items: [],
			total: 0,
			coupon: {
				code: null,
				value: null
			}
		});
	}
}
