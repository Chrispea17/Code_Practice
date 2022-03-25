<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Home route
Route::get('/', function () {
    $files = File::files(resource_path("posts/"));
    $documents = [];
    foreach ($files as $file) {
        $documents[] = YamlFrontMatter::parseFile(
            $file);
    }
    return $documents[1]->title;
});
    //    return view('posts',[
//        'post'=> Post::all()
//    ]);
//});
//route to blog post
Route::get('posts/{post}', function ($slug) {

    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('post', '[A-z/-]+');
