<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        // dd(request(['search']));
        return view('blogs',[
            'blogs'=>Blog::latest()->filter(request(['search','category','author']))->get(), //eager load //lazy loading
            'categories'=>Category::all()
        ]);
    }

    public function show(Blog $blog){ //Blog::findOrFail($id)
        return view('blog',[
             'blog'=>$blog,
            'randomBlogs'=>Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    // protected function getBlogs(){
    //     return Blog::latest()->filter()->get();
        // $query = Blog::latest();
        // if(request('search')){
        //     $blogs->where('title','LIKE','%'.request('search').'%')
        //           ->orwhere('body','LIKE','%'.request('search').'%');
        // }
        // $query->when(request('search'), function($query,$search){
        //     $query->where('title','LIKE','%'.$search.'%')
        //           ->orwhere('body','LIKE','%'.$search.'%');
        // });
        // return $query->get();
    // }
}
