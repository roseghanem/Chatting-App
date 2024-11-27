<?php

namespace App\Modules\Auth\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'gender',
        'dob',
        'university',
        'college',
        'high_school',
        'education',
        'position',
        'firm',
        'horoscope',
        'religion',
        'county',
        'city',
        'bio',
        'height',
        'exercise',
        'have_kids',
        'want_kids',
        'martial_status',
        'lat',
        'long',
        'smoking',
        'fb_user_id',
        'fcm_token',
        'subscription_plan_id',
        'max_sent_req'
    ];

    protected $with = [
        'languages',
        'images',
        'subscription'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'users_vs_languages');
    }

    public function images()
    {
        return $this->hasMany(UserImage::class);
    }

    public function subscription()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }
}
