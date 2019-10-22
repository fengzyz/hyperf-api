<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/22
 * Time: 17:54
 */

namespace App\Request;


use Hyperf\Validation\Request\FormRequest;

class CodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|max:255',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息
     */
    public function messages(): array
    {
        return [
            'code.required' => 'code is required'
        ];
    }

    /**
     * 获取验证错误的自定义属性
     */
    public function attributes(): array
    {
        return [
            'code' => 'code of request',
        ];
    }
}