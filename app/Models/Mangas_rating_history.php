<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mangas_rating_history extends Model
{
    use HasFactory;

    protected $table = "mangas_rating_history";
    protected $fillable = ["manga_id", "score"];
}
