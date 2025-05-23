<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';
    protected $fillable = [
        'name',
        'region_code',
        'is_active',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
