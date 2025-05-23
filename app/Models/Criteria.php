<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criteria extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'stage_id', 
        'criteria_name', 
        'is_active',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function descriptionChanges()
    {
        return $this->hasMany(DescriptionChange::class);
    }
}
