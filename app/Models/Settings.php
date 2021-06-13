<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Settings
 * @package App\Models
 */
class Settings extends Model
{
    protected $fillable = ['name', 'value'];
    protected $table = 'settings';
}
