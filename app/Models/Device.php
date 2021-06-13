<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class device
 * @package App\Models
 * @param string uId
 * @param string appId
 * @param string os
 * @param string language
 * @param string clientToken
 * @param string status
 */
class Device extends Model
{
    protected $fillable = ['uId', 'appId', 'os', 'language', 'clientToken', 'status'];
    protected $connection = 'mysql';
    protected $table = 'devices';
}
