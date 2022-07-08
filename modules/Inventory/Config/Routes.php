<?php

$routes->group('admin/inventory', ['namespace' => 'Modules\Inventory\Controllers'], function($routes){
  $routes->get('/', 'Items::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add', 'Items::add', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'edit/(:alphanum)', 'Items::edit/$1', ["filter" => "auth"]);
  $routes->get('delete/(:num)', 'Items::delete/$1', ["filter" => "auth"]);
});

