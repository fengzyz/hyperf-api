<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;
use App\Middleware\CorsMiddleware;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::addRoute(['GET', 'POST', 'HEAD'], '/test', 'App\Controller\IndexController@test');
// 该 Group 下的所有路由都将应用配置的中间件
Router::addGroup(
    '/v1', function () {
        Router::get('/user', [\App\Controller\Api\V1\UserController::class, 'index']);
        Router::get('/user/login', [\App\Controller\Api\V1\UserController::class, 'login']);
    },
    ['middleware' => [CorsMiddleware::class]]
);

Router::addServer('ws', function () {
    Router::get('/', 'App\Controller\WebSocketController');
});

Router::addServer('grpc', function () {
    Router::addGroup('/grpc.hi', function () {
        Router::post('/sayHello', 'App\Controller\HiController@sayHello');
    });
});

