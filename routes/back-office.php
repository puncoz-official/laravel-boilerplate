<?php

/** @var \Illuminate\Routing\Router $router */

$router->get(
    '/',
    function () {
        return redirect()->route('back.dashboard');
    }
);

$router->get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

