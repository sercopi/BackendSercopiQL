<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Novel extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function genres()
    {
        return $this->hasMany("App\Models\Genre");
    }
    public function users()
    {
        return $this->belongsToMany("App\Models\User");
    }
    public function novel_chapters()
    {
        return $this->hasMany("App\Models\NovelChapter");
    }
    public function novel_update_history()
    {
        return $this->hasMany("App\Models\Novels_update_history");
    }
    public function novel_rating_history()
    {
        return $this->hasMany("App\Models\Novels_rating_history");
    }
    public function comments()
    {
        return $this->morphMany("App\Models\Comment", "commentable");
    }
    public function ratings()
    {
        return $this->morphMany("App\Models\Rating", "ratingable");
    }
    public function updateRating()
    {
        $rating = $this->ratings()->select(DB::raw("AVG(rating) as rating"))->first()->rating;
        if ($rating) {
            $this->update(["score" => round($rating, 2)]);
            $this->novel_rating_history()->create(["score" => $rating]);
        }
        return round($rating, 2);
    }
    public function follows()
    {
        return $this->morphMany("App\Models\Follow", "followable");
    }
}
