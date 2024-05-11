<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->setAutoRoute(true); // URL'leri denetleyici ve yöntemlerle otomatik eşleştirmeyi etkinleştirir.

