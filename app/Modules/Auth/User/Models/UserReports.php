<?php

namespace App\Modules\Auth\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class UserReports extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $table = 'user_reports';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'report_from_user_id ',
        'report_to_user_id ',
        'reason',
    ];

    protected $with = [
        'userRequestFrom',
        'userRequestTo'
    ];

    public function userRequestFrom()
    {
        return $this->belongsTo(User::class, 'report_from_user_id');
    }

    public function userRequestTo()
    {
        return $this->belongsTo(User::class, 'report_to_user_id');
    }

}
