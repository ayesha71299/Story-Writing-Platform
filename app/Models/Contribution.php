<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = ['word_count', 'chapter_id', 'user_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
