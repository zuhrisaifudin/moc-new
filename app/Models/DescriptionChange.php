<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DescriptionChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_id', 
        'description_change_name', 
        'is_active'];
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
