<?php

namespace App\Models\UploadData;

use Illuminate\Database\Eloquent\Model;

class UploadDoc extends Model
{
    protected $table = 'T_UPLOAD_DOC';
    protected $primaryKey = 'UPLOAD_DOC_ID';
    protected $guarded = ['created_at', 'updated_at'];
}
