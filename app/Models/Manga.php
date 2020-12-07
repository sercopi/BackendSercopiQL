<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Manga extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function genre()
    {
        return $this->belongsTo("\App\Models\Genre");
    }
    public function users()
    {
        return $this->belongsToMany("App\Models\User");
    }
    public function comments()
    {
        return $this->morphMany("App\Models\Comment", "commentable");
    }
    public function ratings()
    {
        return $this->morphMany("App\Models\Rating", "ratingable");
    }
    public function manga_update_history()
    {
        return $this->hasMany("App\Models\Mangas_update_history");
    }
    public function manga_rating_history()
    {
        return $this->hasMany("App\Models\Mangas_rating_history");
    }
    public function updateRating()
    {
        $rating = $this->ratings()->select(DB::raw("AVG(rating) as rating"))->first()->rating;
        if ($rating) {
            $this->update(["score" => round($rating, 2)]);
            $this->manga_rating_history()->create(["score" => round($rating, 2)]);
        }
        return round($rating, 2);
    }
    public function follows()
    {
        return $this->morphMany("App\Models\Follow", "followable");
    }
}
