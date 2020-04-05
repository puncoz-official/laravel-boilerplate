<?php

/** @var Router $router */

use Illuminate\Routing\Router;

$router->get(
    '/',
    function () {
        return redirect()->route('back.dashboard');
    }
);

$router->get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

