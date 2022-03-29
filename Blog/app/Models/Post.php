<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

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
        if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }
        return cache()->remember("posts.{$slug}", 20, function () use ($path) {
            return file_get_contents($path);
        });
    }
    public static function all(){
        $files = File::files(resource_path("posts/"));
        return array_map(function($file){
            return $file->getContents();
        }, $files);

    }
}


