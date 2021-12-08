<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    // allow specific column in blogs table
    // protected $fillable=['title','intro','body'];

    //allow every column in blogs table
    protected $guarded = [];
    protected $with = ['category','author'];

    public function category(){
        //hasOne/ hasMany/ belongsTo belongsToMany
        return $this->belongsTo(category::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
}
