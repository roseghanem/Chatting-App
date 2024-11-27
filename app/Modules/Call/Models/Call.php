<?php

namespace App\Modules\Call\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;
    protected $table = 'calls';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'from_user_id',
        'to_user_id'
    ];
}
