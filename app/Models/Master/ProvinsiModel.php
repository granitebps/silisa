<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class ProvinsiModel extends Model
{
    protected $table = 'M_PROVINSI';
    protected $primaryKey = 'ID_PROVINSI';
    protected $guarded = ['created_at', 'updated_at'];

    public function kabupaten()
    {
        return $this->hasMany('App\Models\Master\KabupatenKotaModel', 'ID_PROVINSI', 'ID_PROVINSI');
    }
}
