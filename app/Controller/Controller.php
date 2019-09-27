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

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;
use Hyperf\View\RenderInterface;
use \Phper666\JwtAuth\Jwt;


abstract class Controller
{
    
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var Jwt
     */
    protected $jwt;

    protected $view;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request   = $container->get(RequestInterface::class);
        $this->response  = $container->get(ResponseInterface::class);
        $this->jwt       = $container->get(Jwt::class);
        $this->view      = $container->get(RenderInterface::class);
    }
}
