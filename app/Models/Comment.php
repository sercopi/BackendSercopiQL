<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Comment extends Model
{
    use HasFactory;
    protected $fillable = ["comment", "rating"];
    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
    public function likes()
    {
        return $this->hasMany("App\Models\Like");
    }
    public function comments()
    {
        return $this->morphMany("App\Models\Comment", "commentable");
    }
    public function getLikes(): Int
    {
        $total = $this->likes()->select(DB::raw('SUM(likes.like) as total'))->first()->total;
        return !is_null($total) ? $total : 0;
    }
}
