<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function articles(){
        return $this->belongsToMany('App\Models\article','article_tags');
    }
}
