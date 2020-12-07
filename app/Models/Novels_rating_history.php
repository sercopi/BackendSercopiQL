<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novels_rating_history extends Model
{
    use HasFactory;
    protected $table = "novels_rating_history";
    protected $fillable = ["manga_id", "score"];
}
