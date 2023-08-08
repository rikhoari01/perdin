<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perdin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_from',
        'city_to',
        'date_from',
        'date_to',
        'information',
        'status',
        'total_day',
        'total_distance',
        'total_fee',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
