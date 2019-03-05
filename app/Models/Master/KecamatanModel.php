<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class KecamatanModel extends Model
{
    protected $table = 'M_KECAMATAN';
    protected $primaryKey = 'ID_KECAMATAN';
    protected $guarded = ['created_at', 'updated_at'];

    public function kabupaten()
    {
        return $this->belongsTo('App\Models\Master\KabupatenKotaModel', 'ID_KABUPATEN_KOTA', 'ID_KABUPATEN_KOTA');
    }

    public function desa()
    {
        return $this->hasMany('App\Models\Master\DesaModel', 'ID_KECAMATAN', 'ID_KECAMATAN');
    }
}
