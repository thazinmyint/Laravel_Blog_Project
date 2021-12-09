<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {

        return view('blogs',[
            'blogs'=>$this->getBlogs(), //eager load //lazy loading
            'categories'=>Category::all()
        ]);
    }

    public function show(Blog $blog){ //Blog::findOrFail($id)
        return view('blog',[
             'blog'=>$blog,
            'randomBlogs'=>Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    protected function getBlogs(){
        $blogs = Blog::latest();
        if(request('search')){
            $blogs->where('title','LIKE','%'.request('search').'%')
                  ->orwhere('body','LIKE','%'.request('search').'%');
        }
        return $blogs->get();
    }
}