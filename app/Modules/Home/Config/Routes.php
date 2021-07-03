<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}


// $routes->group('/', ['namespace' => 'Modules\Home\Controllers'], function($subroutes){

// 	/*** Route for Home  ***/
// 	$subroutes->add('/', 'Home::index');
//     $subroutes->add('getProducts', 'Home::getProducts');

// });

$routes->add('/danh-muc/(:segment)', 'Home::categories/$1');
$routes->add('/san-pham/(:segment)', 'Home::product/$1');
$routes->add('/search', 'Home::search');
$routes->add('cart', 'Home::cart');
$routes->add('site/checkout', 'Home::checkout');
$routes->add('remove_cart', 'Home::remove_cart');
$routes->post('/ajaxAddToCart', 'Home::ajaxAddToCart');
$routes->post('/ajaxDeleteCart', 'Home::ajaxDeleteCart');
$routes->get('/ajaxOrder', 'Home::ajaxOrder');
$routes->get('/update-cart', 'Home::ajaxUpdateCart');

