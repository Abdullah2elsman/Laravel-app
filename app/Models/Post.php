<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'desc', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    protected static function booted()
    {
        static::deleting(function ($post)
        {
            if ($post->image && Storage::disk('public')->exists($post->image))
            {
                Storage::disk('public')->delete($post->image);
            }
        });
    }
}
