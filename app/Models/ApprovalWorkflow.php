<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalWorkflow extends Model
{
    protected $fillable = [
        'moc_request_id',
        'user_id',
        'stage',
        'status',
        'note',
        'approved_at',
    ];

     public function mocRequest()
    {
        return $this->belongsTo(MocRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
