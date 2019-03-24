<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class RayonModel extends Model
{
    protected $table = 'M_RAYON';
    protected $primaryKey = 'ID_RAYON';
    protected $guarded = ['created_at', 'updated_at'];

    public function desa()
    {
        return $this->hasMany('App\Models\Master\DesaModel', 'ID_WILAYAH', 'ID_WILAYAH');
    }
}
