<?php
require_once 'Basket.php';

$product_catalogues = [["product_name" => "Red Widget", "product_code" => "R01", "price" => 32.95], ["product_name" => "Green Widget", "product_code" => "G01", "price" => 24.95], ["product_name" => "Blue Widget", "product_code" => "B01", "price" => 7.95]];

$basketObj = new Basket($product_catalogues, true); // create the object of busket

// 1st test
$basketObj->add('B01'); // add products
$basketObj->add('G01');

// 2nd test
/*
$basketObj->add('R01');
$basketObj->add('R01');
*/
// 3rd test
/*
$basketObj->add('R01');
$basketObj->add('G01');
*/
// 4th test

/*
$basketObj->add('B01');
$basketObj->add('B01');
$basketObj->add('R01');
$basketObj->add('R01');
$basketObj->add('R01');
*/
$total_cost = $basketObj->total();
echo "Total Cost of this Basket is: $total_cost".PHP_EOL;
?>