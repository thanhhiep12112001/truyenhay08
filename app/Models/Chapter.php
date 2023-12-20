<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'story_id', 'status', 'chapter_name', 'chapter_content', 'slug_chapter','mo_ta'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chapter';
    public function Story() {
        return $this->belongsTo('App\Models\Story');
    }

}
