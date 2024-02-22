<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    public $timestamps = false;

    public function movie(){
        return $this->belongsTo(Movie::class,'movie_id','id');
    }
}
