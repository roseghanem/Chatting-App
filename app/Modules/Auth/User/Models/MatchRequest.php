<?php

namespace App\Modules\Auth\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_from',
        'request_to',
        'status'
    ];

    protected $with = [
        'status',
        'userRequestFrom',
        'userRequestTo'
    ];

    public function status()
    {
        return $this->belongsTo(MatchingStatuses::class, 'status');
    }

    public function userRequestFrom()
    {
        return $this->belongsTo(User::class, 'request_from');
    }

    public function userRequestTo()
    {
        return $this->belongsTo(User::class, 'request_to');
    }
}
