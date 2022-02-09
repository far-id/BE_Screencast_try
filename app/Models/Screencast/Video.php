<?php

namespace App\Models\Screencast;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'unique_video_id', 'episode', 'runtime', 'intro'];
    protected $with = ['playlist'];
    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
