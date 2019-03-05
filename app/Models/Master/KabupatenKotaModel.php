<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KabupatenKotaModel extends Model
{
    protected $table = 'M_KABUPATEN_KOTA';
    protected $primaryKey = 'ID_KABUPATEN_KOTA';
    protected $guarded = ['created_at', 'updated_at'];

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Master\ProvinsiModel', 'ID_PROVINSI', 'ID_PROVINSI');
    }

    public function kecamatan()
    {
        return $this->hasMany('App\Models\Master\KecamatanModel', 'ID_KABUPATEN_KOTA', 'ID_KABUPATEN_KOTA');
    }
}
