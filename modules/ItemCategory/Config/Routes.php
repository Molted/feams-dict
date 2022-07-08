<?php

$routes->group('admin/category', ['namespace' => 'Modules\ItemCategory\Controllers'], function($routes){
  $routes->get('/', 'Categories::index', ["filter" => "auth"]);
  $routes->match(['get', 'post'], 'add', 'Categories::add', ["filter" => "auth"]);
  $routes->get('delete/(:num)', 'Categories::delete/$1', ["filter" => "auth"]);
});