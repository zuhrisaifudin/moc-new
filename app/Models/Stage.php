<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'stages_name',
        'type_form',
        'is_active',
    ];

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }
}
