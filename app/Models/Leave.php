<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    protected $fillable = [
        'user_id',
        'leave_type',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'status',
        'approved_by',
        'approval_comment',
        'approved_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public static function getLeaveTypes()
    {
        return [
            'sick' => 'ลาป่วย',
            'vacation' => 'ลาพักผ่อน',
            'family' => 'ลาครอบครัว',
            'study' => 'ลาศึกษาต่อ',
            'other' => 'ลาอื่นๆ',
        ];
    }
}