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
    },

);
$routes->group(
    'admin/article',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Article::index');
        $routes->add('addart', 'Admin\Article::addart');
        $routes->add('editart', 'Admin\Article::editart');
        $routes->add('delete', 'Admin\Article::delete');
    }

);
$routes->group(
    'article',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Article::index');
        $routes->add('addart', 'Admin\Article::addart');
        $routes->add('editart', 'Admin\Article::editart');
        $routes->add('delete', 'Admin\Article::delete');
    }

);
$routes->group(
    'admin/page',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Page::index');
        $routes->add('index', 'Admin\Page::index');
        $routes->add('addpg', 'Admin\Page::addPg');
        $routes->add('editpg', 'Admin\Page::editPg');
        $routes->add('delpg', 'Admin\Page::delPg');
    }

);
$routes->group(
    'page',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Page::index');
        $routes->add('index', 'Admin\Page::index');
        $routes->add('addpg', 'Admin\Page::addPg');
        $routes->add('editpg', 'Admin\Page::editPg');
        $routes->add('delpg', 'Admin\Page::delPg');
    }

);
$routes->group(
    'admin/sosmed',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Sosmed::index');
        $routes->add('index', 'Admin\Sosmed::index');
        $routes->add('addsm', 'Admin\Sosmed::addSm');
        $routes->add('editsm', 'Admin\Sosmed::editSm');
        $routes->add('delsm', 'Admin\Sosmed::delSm');
    }

);
$routes->group(
    'sosmed',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Sosmed::index');
        $routes->add('index', 'Admin\Sosmed::index');
        $routes->add('addsm', 'Admin\Sosmed::addSm');
        $routes->add('editsm', 'Admin\Sosmed::editSm');
        $routes->add('delsm', 'Admin\Sosmed::delSm');
    }

);

$routes->group(
    'account',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Account::index');
        $routes->add('index', 'Admin\Account::index');
    }

);
$routes->group(
    'admin/account',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->add('', 'Admin\Account::index');
        $routes->add('index', 'Admin\Account::index');
    }

);
// $routes->group(
//     '/',
//     ['filter' => 'auth'],
//     function ($routes) {
//     }
// );
$routes->add('article/(:any)', 'ArticleB::index/$1');
$routes->add('article/(:any)', 'ArticleB::index/$1');
$routes->get('/', 'front::index');
