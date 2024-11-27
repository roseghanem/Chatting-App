<?php

namespace App\Modules\ViewedStatus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewedStatus extends Model
{
    use HasFactory;
    protected $table = 'viewed_statuses';

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
