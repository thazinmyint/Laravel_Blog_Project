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

    public function scopeFilter($query, $filter)//Blog::latest()->filter()
    {
        // dd($filter);
        $query->when($filter['search'] ?? false, function($query,$search){
                $query->where(function ($query) use ($search){
                    $query-> where('title','LIKE','%'.$search.'%')
                        ->orWhere('body','LIKE','%'.$search.'%');
                });
            });
        $query->when($filter['category'] ?? false, function($query,$slug){
                // dd($slug);
                $query->whereHas('category', function ($query) use ($slug){
                    $query->where('slug',$slug);
                });
            });
        
    }

    public function category(){
        //hasOne/ hasMany/ belongsTo belongsToMany
        return $this->belongsTo(category::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
}
