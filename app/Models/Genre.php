<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mangas()
    {
        return $this->hasMany("App\Models\Manga");
    }
    public function novels()
    {
        return $this->hasMany("App\Models\Novel");
    }
}
