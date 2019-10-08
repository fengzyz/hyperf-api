<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class FooRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'foo' => 'required|max:255',
            'bar' => 'required',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息
     */
    public function messages(): array
    {
        return [
            'foo.required' => 'foo is required',
            'bar.required'  => 'bar is required',
        ];
    }

    /**
     * 获取验证错误的自定义属性
     */
    public function attributes(): array
    {
        return [
            'foo' => 'foo of request',
        ];
    }
}
