<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseRegion extends Model
{
    protected $fillable = [
        'title',
        'asuse_name',
        'omnius_link',
        'asuse_code_dep',
        'omnius_division',
        'asuse_alias',
        'description',
        'id_tns_name'
    ];

    public function tns() {
        return $this->hasOne(TnsName::class, 'title', 'title');
    }
}
