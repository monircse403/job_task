<?php


interface ProductCatalogue {

	public function __construct($product_catalogue, $delivery_charge_rules);
	public function add($product_code);
	public function total();

}