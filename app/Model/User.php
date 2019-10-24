<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/10/23
 * Time: 9:01
 */
namespace App\Model;

/**
 * @property int $id
 * @property string $nickname
 * @property string $avatar
 * @property int $gender
 * @property string $openid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nickname', 'avatar', 'gender', 'openid', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'gender' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}