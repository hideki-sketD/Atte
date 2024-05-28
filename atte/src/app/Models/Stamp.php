<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'punchIn', 'punchOut', 'workingTime'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
