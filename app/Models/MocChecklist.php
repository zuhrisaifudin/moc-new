<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MocChecklist extends Model
{
    use SoftDeletes;
    public function mocRequest()
    {
        return $this->belongsTo(MocRequest::class);
    }
}
