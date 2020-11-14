<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','is_open','row_content'];

    public function tags(){
        return $this->belongsToMany('App\Models\tag','article_tags');
    }
}
