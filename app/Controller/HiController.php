<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/9/26
 * Time: 15:47
 */

namespace App\Controller;

use Grpc\HiReply;
use Grpc\HiUser;


class HiController
{
    public function sayHello(HiUser $user)
    {

        $message = new HiReply();
        $message->setMessage("Hello World ".$user->getName());
        $message->setUser($user);
        return $message;
    }
}