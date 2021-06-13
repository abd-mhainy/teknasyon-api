<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 * @package App\Models
 */
class Purchase extends Model
{
    protected $fillable = ['deviceId', 'receipt', 'clientToken', 'expireDate'];
    protected $table = 'purchases';
}
