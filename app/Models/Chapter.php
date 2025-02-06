<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['story_id', 'user_id', 'title', 'content', 'word_count'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }}
