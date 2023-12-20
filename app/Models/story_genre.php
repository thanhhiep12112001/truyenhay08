<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class story_genre extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'story_id','genre_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'story_genre';
}
