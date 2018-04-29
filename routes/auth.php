<?php

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application frontend.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** @var \Illuminate\Routing\Router $routes */

// Authentication Routes...
$routes->group(
    ['prefix' => 'login', 'as' => '.login'],
    function () use ($routes) {
        $routes->get('/', 'LoginController@showLoginForm')->name('');
        $routes->post('/', 'LoginController@login')->name('.post');
    }
);
$routes->post('/logout', 'LoginController@logout')->name('.logout');

// Password Reset Routes...
$routes->group(
    ['prefix' => 'password', 'as' => '.password'],
    function () use ($routes) {
        $routes->post('/email', 'ForgotPasswordController@sendResetLinkEmail')->name('.email');
        $routes->get('/reset', 'ForgotPasswordController@showLinkRequestForm')->name('.request');
        $routes->post('/reset', 'ResetPasswordController@reset')->name('.email.post');
        $routes->get('/reset/{token}', 'ResetPasswordController@showResetForm')->name('.reset');
    }
);

// Registration Routes...
$routes->group(
    ['prefix' => 'register', 'as' => '.register'],
    function () use ($routes) {
        $routes->get('/', 'RegisterController@showRegistrationForm')->name('');
        $routes->post('/', 'RegisterController@register')->name('.post');
    }
);
