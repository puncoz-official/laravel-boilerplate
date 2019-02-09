<?php

/** @var \Illuminate\Routing\Router $router */

$router->get('/', 'Home\HomeController@index')->name('home');
