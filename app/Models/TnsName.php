<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TnsName extends Model
{
    protected $fillable = [
        'service_name',
        'host',
        'port',
        'sid',
        'db,',
        'user',
        'password'
    ];
}
