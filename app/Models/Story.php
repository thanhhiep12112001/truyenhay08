<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    public $timestamps = true;//lưu tgian thêm tạo mới
    protected $fillable = [
        'story_name','summary','status','slug_story','photo','category_id','author','genre_id','views','tu_khoa'
    ];
    protected $primaryKey='id';
    protected $table='story';

    public function Category()
    {
         return $this->belongsTo('App\Models\Category','category_id','id');   
    }
    public function Chapter() {
        return $this->hasMany('App\Models\Chapter', 'story_id', 'id');
    }

    public function Genre() {
        return $this->belongsTo('App\Models\Genre','genre_id','id');  
    }

    public function genres() {
        return $this->belongsToMany(Genre::class,'story_genre','story_id','genre_id');  
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'id_user', 'story_id');
    }
}
