<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
    protected $fillable = [
        'name',
        'region_id',
        'district_code',
        'is_active',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
