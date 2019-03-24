<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model
{
    protected $table = 'M_AREA';
    protected $primaryKey = 'ID_AREA';
    protected $guarded = ['created_at', 'updated_at'];

    public function desa()
    {
        return $this->hasMany('App\Models\Master\DesaModel', 'ID_WILAYAH', 'ID_WILAYAH');
    }
}
