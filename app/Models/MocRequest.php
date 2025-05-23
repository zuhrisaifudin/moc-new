<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class MocRequest extends Model
{
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot() {
        parent::boot();

        static::creating(function(Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    protected static function booted()
    {
        static::saving(function ($moc) {
            if ($moc->region_id) {
                $region = Region::find($moc->region_id);
                if ($region) {
                    $moc->region_name = $region->name;
                    $moc->region_code = $region->region_code;
                }
            }
        });

        static::saving(function ($moc) {
            if ($moc->district_id) {
                $district = District::find($moc->district_id);
                if ($district) {
                    $moc->district_name = $district->name;
                    $moc->district_code = $district->district_code;
                }
            }
        });
    }



    protected $guarded = [];

    protected $casts = [
        'examiner_team' => 'array',
        'coordinates' => 'array',
        'date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_temporary' => 'boolean',
        'status' => 'integer',
        'type_of_change' => 'array',
    ];

    protected $dates = [
        'date',
        'start_date',
        'end_date',
        'deleted_at'
    ];

    public function checklists()
    {
        return $this->hasMany(MocChecklist::class);
    }

    public function approvals()
    {
        return $this->hasMany(MocApproval::class);
    }

    public function documents()
    {
        return $this->hasMany(MocDocument::class);
    }

    public function histories()
    {
        return $this->hasMany(MocHistory::class);
    }

    // generate reference number

    public static function generateNumberFromCount()
    {
    
       $count = self::withTrashed()->count() + 1;
        return str_pad($count, 6, '0', STR_PAD_LEFT);
    }


    public static function generateReference(string $departmentCode = '')
    {
        $nextNumber = self::generateNumberFromCount();

        $romanMonths = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        $monthRoman = $romanMonths[Carbon::now()->month];
        $year = Carbon::now()->year;

        return "{$nextNumber}/{$departmentCode}/{$monthRoman}/{$year}";
    }


}
