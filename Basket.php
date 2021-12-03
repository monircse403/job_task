<?php

require_once 'ProductCatalogue.php';

class Basket Implements ProductCatalogue {

	protected $products = [];
	protected $product_catalogue = [];
	protected $delivery_charge_rules = true;

	public function __construct($product_catalogue, $delivery_charge_rules) {
		$this->product_catalogue = $product_catalogue;
		$this->delivery_charge_rules = $delivery_charge_rules;
	}

	public function add($product_code) {
		// TODO: Implement add() method.
		$this->products [] = $product_code;
	}

	public function total() {
		// TODO: Implement total() method.
		$this->products = array_count_values($this->products); // count the similar products to make calculation easy
		$total = 0;
		foreach ($this->products as $product_code => $number_of_product_ordered) { // for each of ordered products
			$total_without_delivery_charge = 0; // total without delivery charge
			foreach ($this->product_catalogue as $products_in_catalogue) { // for each of catalogued products
				if ($product_code == $products_in_catalogue["product_code"]) {
					$product_price = $products_in_catalogue["price"];
					if (($number_of_product_ordered > 1) && ($this->specialOfferCalculate($product_code))) { // if total ordered more than 1 and if special offer true
						$reduced_product_price = ($product_price / 2) ; // give half price always the 1 product
						$total_without_delivery_charge += $product_price * ($number_of_product_ordered - 1) + $reduced_product_price;
					} else {
						$total_without_delivery_charge += $product_price * $number_of_product_ordered;
					}
				}
			}
			$total += $total_without_delivery_charge;
		}

		if ($total > 0) {
			if ($this->delivery_charge_rules) { // if delivery charge rules true
				$delivery_charge = $this->deliveryCharge($total); // get the delivery charge
				$total += $delivery_charge;
			}
		}
		return $total;
	}

	/*
	 * calculate the delivery charge
	 * return float
	 */
	public function deliveryCharge($total) {
		$delivery_charge = 4.95;
		if ($total > 0) {
			if ($total > 50 && $total < 90) {
				$delivery_charge = 2.90;
			} elseif ($total > 90) {
				$delivery_charge = 0;
			}
		}
		return $delivery_charge;
	}

	/*
	 * check if the 2nd product of R01 and give special discount
	 */
	public function specialOfferCalculate($product_code) {
		foreach ($this->product_catalogue as $products) {
			if ($product_code == $products["product_code"] && $product_code == 'R01') {
				return true;
			}
		}
	}

	/**
	 * @return array
	 */
	public function getProductCatalogue() {
		return $this->product_catalogue;
	}

	/**
	 * @return array
	 */
	public function getProducts() {
		return $this->products;
	}
}