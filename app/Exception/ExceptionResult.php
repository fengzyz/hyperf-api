<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/5/15
 * Time: 11:09
 */

namespace App\Exception;
use \Exception;

class ExceptionResult extends  Exception
{
    /**
     * @var $string
     */
    protected $message;
    /**
     * @var $string
     */
    protected $code;
    /**
     * @var array
     */
    protected static $messageTemplate = [];

    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    // 自定义字符串输出的样式 */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    /**
     * set default template config
     * @param array $template
     * @return $this
     */
    public static function setMsgTemplate(array $template = [])
    {
        static::$messageTemplate = $template;
    }

    /**
     * get error msg template
     * @return array
     */
    public static function getMsgTemplate()
    {
        return static::$messageTemplate;
    }


    /**
     * error information to array data
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
        ];
    }

    /**
     * throwException
     * @param $msgCode
     * @param array $args
     */
    public static function throwException($msgCode, array $args = [])
    {
        $class = __CLASS__;
        $message = static::getMsg($msgCode);
        if (!empty($args)) {
            foreach ($args as $key => $value) {
                $message = str_replace('%' . $key, $value, $message);
            }
        }
        throw new $class($message, $msgCode);
    }

    /**
     * get message
     * @param $msgCode
     * @return mixed
     */
    public static function getMsg($msgCode)
    {
        static::getMsgTemplate();
        $message = static::$messageTemplate;
        if (empty($message)) {
            throw new \RuntimeException("Message Template Is Not Set");
        }

        if (!isset($message[$msgCode])) {
            throw new \RuntimeException("MsgCode Not Found Message Value");
        }

        return $message[$msgCode];
    }
}