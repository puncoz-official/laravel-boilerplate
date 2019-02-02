<?php

/** @var \Illuminate\Routing\Router $router */

$router->get('/', 'Dashboard\DashboardController@index')->name('dashboard');
