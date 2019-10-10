<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/10
 * Time: 9:07
 */

declare(strict_types=1);

namespace App\Exception;

use App\Constants\StatusCode;
use Throwable;

class ParamaterException extends BusinessException
{
    public function __construct(string $message = null, $data = null, Throwable $previous = null)
    {
        parent::__construct(StatusCode::ParamaterInvalid, $message, $data, $previous);
    }
}
