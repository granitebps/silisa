<?php

namespace App\Models\DesaPrioritas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesaPrioritasModel extends Model
{
    use SoftDeletes;
    protected $table = 'T_DESA_PRIORITAS';
    protected $primaryKey = 'ID_DESA_PRIORITAS';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function desa()
    {
        return $this->belongsTo('App\Models\Master\DesaModel', 'ID_DESA', 'ID_DESA');
    }
}
