<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = ['topic', 'message', 'status', 'user_id'];
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
