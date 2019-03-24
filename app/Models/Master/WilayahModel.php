<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class WilayahModel extends Model
{
    protected $table = 'M_WILAYAH';
    protected $primaryKey = 'ID_WILAYAH';
    protected $guarded = ['created_at', 'updated_at'];

    public function desa()
    {
        return $this->hasMany('App\Models\Master\DesaModel', 'ID_WILAYAH', 'ID_WILAYAH');
    }
}
