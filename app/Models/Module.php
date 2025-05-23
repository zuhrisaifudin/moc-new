<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'core',
        'is_active'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
