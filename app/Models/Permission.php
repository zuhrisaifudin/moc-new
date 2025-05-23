<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends SpatiePermission
{
    use HasFactory, SoftDeletes;
    public $guarded = [];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }


}
