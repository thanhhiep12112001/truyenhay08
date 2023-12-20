<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'genre_name','status', 'slug_genre','mo_ta'
    ];
    protected $primaryKey = 'id';
    protected $table = 'genre';
    public function Story() {
        return $this->hasMany('App\Models\Story');
    }
}

