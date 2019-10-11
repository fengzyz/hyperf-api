<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/8/13
 * Time: 9:05
 */

namespace App\Controller\Api\V1;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use App\Controller\Controller as BaseController;

/**
 * @Controller()
 * Class UserController
 * @package App\Controller\Api\V1
 */
class UserController extends BaseController
{

    public function index(){
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }
    /**
     *
     */
    public function login(){


        $username = $this->request->input('username');
        $password = $this->request->input('password');
        if ($username && $password) {
            $userData = [
                'uid' => 1, // 如果使用单点登录，必须存在配置文件中的sso_key的值，一般设置为用户的id
                'username' => 'xx',
            ];
            $token = $this->jwt->getToken($userData);
            $data = [
                'code' => 0,
                'msg' => 'success',
                'data' => [
                    'token' => (string)$token,
                    'exp' => $this->jwt->getTTL(),
                ]
            ];
            return $this->response->json($data);
        }
        return $this->response->json(['code' => 0, 'msg' => '登录失败', 'data' => []]);
    }
    /*
     * 刷新token，http头部必须携带token才能访问的路由
     * @RequestMapping(path="refresh", methods="get,post")
     */
    public function refreshToken()
    {
        $token = $this->jwt->refreshToken();
        $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'token' => (string)$token,
                'exp' => $this->jwt->getTTL(),
            ]
        ];
        return $this->response->json($data);
    }

    # 注销token，http头部必须携带token才能访问的路由
    public function logout()
    {
        $this->jwt->logout();
        return true;
    }

    # http头部必须携带token才能访问的路由
    public function getData()
    {
        $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'cache_time' => $this->jwt->getTokenDynamicCacheTime() // 获取token的有效时间，动态的
            ]
        ];
        return $this->response->json($data);
    }
    /**
     * @return array
     * @RequestMapping(path="test", methods="get,post")
     */
    public function test(){
        return $this->view->render('layouts/default', ['name' => 'Hyperf']);
    }

}