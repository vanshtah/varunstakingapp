<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReturn extends Model
{
    use HasFactory;

    protected $fillable = ['stake_id', 'daily_return', 'date', 'type'];
}
