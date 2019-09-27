<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/9/26
 * Time: 16:15
 */
declare(strict_types=1);

namespace App\Controller;
use Hyperf\HttpServer\Annotation\AutoController;


/**
 * @AutoController
 * Class GrpcController
 * @package App\Controller
 */
class GrpcController extends Controller
{
    public function hello()
    {
        $client = new \App\Grpc\HiClient('127.0.0.1:9503', [
            'credentials' => null,
        ]);
        $userName = $this->request->input('username',"wangwu");
        $sex      = $this->request->input('sex',30);
        $hiUser = new \Grpc\HiUser();
        $hiUser->setName($userName);
        $hiUser->setSex($sex);

        /**
         * @var \Grpc\HiReply $reply
         */
        list($reply, $status) = $client->sayHello($hiUser);

        $message = $reply->getMessage();
        $user = $reply->getUser();

        $client->close();
        var_dump(memory_get_usage(true));
        return $message;
    }
}