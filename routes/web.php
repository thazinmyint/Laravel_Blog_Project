<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/', [BlogController::class,'index']);

Route::get('/blogs/{blog:slug}',[BlogController::class,'show'])->where('blog','[A-z\d\-_]+'); //first blog=>first-blog

// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('blogs',[
//         'blogs'=>$category->blogs,
//         'categories'=>Category::all(),
//         'currentCategory'=>$category
// ]);
// });
// Route::get('/users/{user:username}', function (User $user) {
//     // dd($user);
//     return view('blogs',[
//         'blogs'=>$user->blogs,
//     ]);
// });
