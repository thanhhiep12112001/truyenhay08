<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;//lưu tgian thêm tạo mới
    protected $fillable = [
        'Categoryname','Desc_category','Status','Slug_cate'
    ];
    protected $primaryKey='id';
    protected $table='category';

    public function story()
    {
         return $this->hasMany('App\Models\Story');   
    }
}
