<?php

namespace App\Modules\Auth\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];
}
