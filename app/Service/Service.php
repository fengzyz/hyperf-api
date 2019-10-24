<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/23
 * Time: 9:04
 */

namespace App\Service;
use Hyperf\Contract\StdoutLoggerInterface;
use Psr\Container\ContainerInterface;
use Hyperf\Config\Annotation\Value;

abstract class Service
{

    protected $miniProgram;

    /**
     * @Value("wechat")
     */
    private $configValue;

    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $container->get(StdoutLoggerInterface::class);
        $this->miniProgram = new \EasySwoole\WeChat\MiniProgram\MiniProgram;
        $this->miniProgram->getConfig()->setAppId($this->configValue['app_id'])->setAppSecret($this->configValue['secret']);
    }
}