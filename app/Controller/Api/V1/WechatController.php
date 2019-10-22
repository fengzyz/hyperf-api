<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/22
 * Time: 16:43
 */

namespace App\Controller\Api\V1;
use App\Request\CodeRequest;
use Hyperf\Config\Annotation\Value;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use App\Controller\Controller as BaseController;
use Psr\Container\ContainerInterface;

/**
 * @Controller()
 * Class WechatController
 * @package App\Controller\Api\V1
 */
class WechatController extends BaseController
{
    protected $miniProgram;

    /**
     * @Value("wechat")
     */
    private $configValue;
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->miniProgram = new \EasySwoole\WeChat\MiniProgram\MiniProgram;
        $this->miniProgram->getConfig()->setAppId($this->configValue['app_id'])->setAppSecret($this->configValue['secret']);
    }

    /**
     * @RequestMapping(path="login", methods="get,post")
     * 用户登录
     */
    public function login(CodeRequest $request){
        $validated = $request->validated();
        if($validated){
            return "验证成功!";
        }
    }
}