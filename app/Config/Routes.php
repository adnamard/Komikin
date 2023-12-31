<?php

use App\Controllers\Pembayaran;
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
$routes->get('Auth/login', 'Auth::login');


$routes->get('Home/', 'Home::index');
$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);
$routes->get('Admin/', 'Admin::index');


$routes->get('Admin/listkomik', 'Admin::listkomik');
$routes->get('Admin/user', 'Admin::listuser');
$routes->get('Admin/profile', 'Admin::profile');
$routes->get('komik/(:segment)', 'Admin::detail/$1');
$routes->get('komik/', 'Admin::listkomik');
$routes->get('/Admin/create', 'Admin::create');
$routes->post('/Admin/save', 'Admin::save');
$routes->delete('admin/delete/(:num)', 'Admin::delete/$1');
$routes->get('Admin/edit/(:segment)', 'Admin::edit/$1');

$routes->post('admin/update/(:segment)', 'Admin::update/$1');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');


$routes->get('/checkout/add/(:segment)', 'Checkout::add/$1');
$routes->get('Checkout/', 'Checkout::index');
$routes->get('add/(:num)', 'CCheckoutClient::addCheckout/$1');
$routes->delete('Checkout/delete/(:num)', 'Checkout::delete/$1');
$routes->post('Checkout/bayar', 'Checkout::bayar');
$routes->get('DataCheckout/', 'DataCheckout::index');

$routes->get('Pembayaran/pending', 'Pembayaran::pending');
$routes->post('Pembayaran/update/(:segment)', 'Pembayaran::update/$1');
$routes->get('Pembayaran/diterima', 'Pembayaran::diterima');
$routes->get('Pembayaran/ditolak', 'Pembayaran::ditolak');

$routes->get('Auth/logout', 'Auth::logout');
