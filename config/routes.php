<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    $routes->applyMiddleware('csrf');


    $routes->get('/', ['controller' => 'Pages', 'action' => 'tapume']);
    $routes->get('/home', ['controller' => 'Pages', 'action' => 'home']);
    $routes->get('/sobre', ['controller' => 'Pages', 'action' => 'sobre']);
    $routes->post('/newsletter', ['controller' => 'Pages', 'action' => 'newsletter']);
    $routes->connect('/contato', ['controller' => 'Pages', 'action' => 'contato']);
    $routes->get('/buscar', ['controller' => 'Pages', 'action' => 'buscar']);
    $routes->get('/descontos', ['controller' => 'Discounts', 'action' => 'index']);
    $routes->get('/videos', ['controller' => 'Videos', 'action' => 'index']);
    $routes->get('/tags/:tag', ['controller' => 'Tags', 'action' => 'buscar'])->setPass(['termo']);
 
    $routes->get('/clean', ['controller' => 'Pages', 'action' => 'clean']);

    $routes->get('/:menu', ['controller' => 'Pages', 'action' => 'destinos'])->setPass(['menu']);
    $routes->get('/:menu/:region', ['controller' => 'Pages', 'action' => 'destinos'])->setPass(['menu','region']);
    $routes->get('/:menu/:region/:location', ['controller' => 'Pages', 'action' => 'destinos'])->setPass(['menu','region','location']);

    $routes->connect('/p/:id/:slug', ['controller' => 'Pages', 'action' => 'artigo'])->setPass(['id','slug'])->setPatterns(['id' => '\d+']);
    

    $routes->fallbacks(DashedRoute::class);
   
});

Router::scope('/adm', ['prefix' => 'adm'], function ($routes) {
 // Register scoped middleware for in scopes.s
        $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
            'httpOnly' => true
        ]));

        $routes->applyMiddleware('csrf');
        $routes->connect('/', ['controller' => 'Pages', 'action' => 'home']);
        $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
        $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
        $routes->fallbacks(DashedRoute::class);
        
});

