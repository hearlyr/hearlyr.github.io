<?php

use CodeIgniter\Router\RouteCollection;
use App\Filters;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->add('admin/logout', 'Admin\Admin::logout');

$routes->group(
    'admin',
    ['filter' => 'noauth'],
    function ($routes) {
        $routes->add('', 'Admin\Admin::index');
        $routes->add('index', 'Admin\Admin::index');
        $routes->add('resetpw', 'Admin\Admin::resetpw');
        $routes->add('forgotpw', 'Admin\Admin::forgotpw');
        $routes->add('regist', 'Admin\Admin::regist');
        // $routes->add('main', 'Admin\Admin::main');
        // $routes->add('article', 'Admin\Article::index');
    }

);
$routes->group(
    'admin',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('article', 'Admin\Article::index');
        $routes->add('article/addart', 'Admin\Article::addart');
    }

);
$routes->group(
    '/',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->get('', 'Admin\Article::index');
    }
);
