<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/home', 'Home::index');
$routes->get('/', 'Home::index');


$routes->get('/Auth/loginpage', 'Auth::loginpage');
$routes->get('/Auth/registerpage', 'Auth::registerpage');
$routes->get('Auth/register', 'Auth::registerpage');
$routes->post('/auth/register', 'Auth::register');
$routes->post('/auth/login', 'Auth::login');


$routes->get('Home/', 'Home::index');
$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);
$routes->get('Admin/', 'Admin::index');


$routes->get('Auth/logout', 'Auth::logout');
