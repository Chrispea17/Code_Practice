<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $date;
    public $excerpt;
    public $body;
    public $slug;

    /**
     * @param $title
     * @param $date
     * @param $excerpt
     * @param $body
     */
    public function __construct($title, $date, $excerpt, $body, $slug)
    {
        $this->title = $title;
        $this->date = $date;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function find($slug)
    {
        return static::all()->firstwhere('slug', $slug);
    }

    public static function findorFail($slug)
    {
        $post = static::find($slug);

        if (! $post) {
            throw new ModelNotFoundException();
        }

    }

    public static function all()
    {
        //return cache()->rememberForever('posts.all', function(){
        return collect(File::files(resource_path("posts/")))->
        map(function ($file) {
            return YamlFrontMatter::parseFile($file);
        })->
        map(function ($documents) {
            ;
            return new Post(
                $documents->title,
                $documents->date,
                $documents->excerpt,
                $documents->body(),
                $documents->slug
            );
        })->
        sortByDesc('date');
        //});
    }
}
