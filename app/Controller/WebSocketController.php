<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/8
 * Time: 16:13
 */

namespace App\Controller;

use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\WebSocket\Server as WebSocketServer;
use Swoole\Websocket\Frame;


class WebSocketController implements OnMessageInterface, OnOpenInterface
{
    public function onMessage(WebSocketServer $server, Frame $frame): void
    {
        $server->push($frame->fd, 'Recv: ' . $frame->data);
    }

    public function onOpen(WebSocketServer $server, Request $request): void
    {
        $server->push($request->fd, 'Opened');
    }
}