<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}


$routes->group('admin', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

	/*** Route for admin  ***/
	$subroutes->add('/', 'Admin::login');
    $subroutes->add('dashboard', 'Admin::index');
    $subroutes->add('logout', 'Admin::logout');
    $subroutes->add('getProducts', 'Admin::getProducts');
    $subroutes->post('ajaxLogin', 'Admin::ajaxLogin');

});

$routes->group('categories', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    // categories 
    $subroutes->add('/', 'Categories::index');
    $subroutes->add('addCategories', 'Categories::addCategories');
    $subroutes->add('updateCategories', 'Categories::updateCategories');
    $subroutes->post('ajaxAddCategories', 'Categories::ajaxAddCategories');
    $subroutes->post('ajaxUpdateCategories', 'Categories::ajaxUpdateCategories');
    $subroutes->post('ajaxDeleteCategories', 'Categories::ajaxDeleteCategories');
    $subroutes->post('ajaxActionCategories', 'Categories::ajaxActionCategories');
});

$routes->group('units', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Units::index');
    $subroutes->add('addUnits', 'Units::addUnits');
    $subroutes->add('updateUnits', 'Units::updateUnits');
    $subroutes->post('ajaxAddUnits', 'Units::ajaxAddUnits');
    $subroutes->post('ajaxUpdateUnits', 'Units::ajaxUpdateUnits');
    $subroutes->post('ajaxDeleteUnits', 'Units::ajaxDeleteUnits');
    $subroutes->post('ajaxActionUnit', 'Units::ajaxActionUnit');
});

$routes->group('warehouse', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Warehouse::index');
    $subroutes->add('addWarehouse', 'Warehouse::addWarehouse');
    $subroutes->add('updateWarehouse', 'Warehouse::updateWarehouse');
    $subroutes->post('ajaxAddWarehouse', 'Warehouse::ajaxAddWarehouse');
    $subroutes->post('ajaxUpdateWarehouse', 'Warehouse::ajaxUpdateWarehouse');
    $subroutes->post('ajaxDeleteWarehouse', 'Warehouse::ajaxDeleteWarehouse');
    $subroutes->post('ajaxActionWarehouse', 'Warehouse::ajaxActionWarehouse');
});

$routes->group('tags', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Tags::index');
    $subroutes->add('addTags', 'Tags::addTags');
    $subroutes->add('updateTags', 'Tags::updateTags');
    $subroutes->post('ajaxAddTags', 'Tags::ajaxAddTags');
    $subroutes->post('ajaxUpdateTags', 'Tags::ajaxUpdateTags');
    $subroutes->post('ajaxDeleteTags', 'Tags::ajaxDeleteTags');
    $subroutes->post('ajaxActionTags', 'Tags::ajaxActionTags');
});

$routes->group('provider', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Provider::index');
    $subroutes->add('addProvider', 'Provider::addProvider');
    $subroutes->add('updateProvider', 'Provider::updateProvider');
    $subroutes->post('ajaxAddProvider', 'Provider::ajaxAddProvider');
    $subroutes->post('ajaxUpdateProvider', 'Provider::ajaxUpdateProvider');
    $subroutes->post('ajaxDeleteProvider', 'Provider::ajaxDeleteProvider');
    $subroutes->post('ajaxActionProvider', 'Provider::ajaxActionProvider');
});

$routes->group('customer', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Customer::index');
    $subroutes->add('updateCustomer', 'Customer::updateCustomer');
    $subroutes->post('ajaxAddCustomer', 'Customer::ajaxAddCustomer');
    $subroutes->post('ajaxUpdateCustomer', 'Customer::ajaxUpdateCustomer');
    $subroutes->post('ajaxDeleteCustomer', 'Customer::ajaxDeleteCustomer');
    $subroutes->post('ajaxActionCustomer', 'Customer::ajaxActionCustomer');
});

$routes->group('products', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Products::index');
    $subroutes->add('addProducts', 'Products::addProducts');
    $subroutes->add('updateProducts', 'Products::updateProducts');
    $subroutes->post('ajaxAddProducts', 'Products::ajaxAddProducts');
    $subroutes->post('ajaxUpdateProducts', 'Products::ajaxUpdateProducts');
    $subroutes->post('ajaxChangeStatusProducts', 'Products::ajaxChangeStatusProducts');
    $subroutes->post('ajaxActionProducts', 'Products::ajaxActionProducts');
});

$routes->group('purchase', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Purchase::index');
    $subroutes->add('printBill', 'Purchase::printBill');
    $subroutes->add('addPurchase', 'Purchase::addPurchase');
    $subroutes->add('updatePurchase', 'Purchase::updatePurchase');
    $subroutes->add('getPurchaseDetail', 'Purchase::getPurchaseDetail');
    $subroutes->post('ajaxAddPurchase', 'Purchase::ajaxAddPurchase');
    $subroutes->post('ajaxUpdatePurchase', 'Purchase::ajaxUpdatePurchase');
    $subroutes->post('ajaxDeletePurchase', 'Purchase::ajaxDeletePurchase');
    $subroutes->post('ajaxActionPurchase', 'Purchase::ajaxActionPurchase');
});

$routes->group('inventory', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Inventory::index');
});

$routes->group('order', ['namespace' => 'Modules\Admin\Controllers'], function($subroutes){

    $subroutes->add('/', 'Order::index');
    $subroutes->add('printBill', 'Order::printBill');
    $subroutes->add('addOrder', 'Order::addOrder');
    $subroutes->add('updateOrder', 'Order::updateOrder');
    $subroutes->add('getOrderDetail', 'Order::getOrderDetail');
    $subroutes->post('ajaxAddOrder', 'Order::ajaxAddOrder');
    $subroutes->post('ajaxUpdateStatus', 'Order::ajaxUpdateStatus');
    $subroutes->post('ajaxUpdateOrder', 'Order::ajaxUpdateOrder');
    $subroutes->post('ajaxDeleteOrder', 'Order::ajaxDeleteOrder');
    $subroutes->post('ajaxActionOrder', 'Order::ajaxActionOrder');
});