<?php

namespace App\Models;

class Post
{
  private static $blog_posts = [
    [
      "title" => "Judul Post Pertama",
      "slug" => "judul-post-pertama",
      "author" => "Hairul",
      "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam fugit pariatur nostrum inventore vitae ipsa numquam tempore quo, velit doloremque odio accusamus illum sint. Provident perspiciatis id, voluptatem itaque quisquam voluptatum esse officiis illum inventore molestias labore animi soluta non eveniet accusamus dicta praesentium eos pariatur. Nesciunt illo in eveniet dignissimos pariatur molestias iure debitis eligendi neque vitae. Non voluptatum ut velit error repellendus, quibusdam libero. Vel, nostrum accusantium eligendi, ipsum libero reprehenderit eius sunt explicabo, culpa est ratione voluptatem!"
    ],
    [
      "title" => "Judul Post Kedua",
      "slug" => "judul-post-kedua",
      "author" => "Lana",
      "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque, doloremque iste. Numquam laborum provident illo quis cupiditate quam doloremque voluptas, ut odio magni labore ratione tempora rem inventore velit soluta reiciendis voluptatibus dolorem quae pariatur nesciunt nisi at. Maiores, aperiam! Harum, obcaecati dignissimos cupiditate nemo quidem iure rem natus similique ex quis necessitatibus at dolorum, inventore possimus architecto maiores tenetur tempora aperiam eligendi, exercitationem officia? Perspiciatis vero reprehenderit quaerat culpa soluta praesentium quae quia? Est aspernatur beatae praesentium vitae dolorum laudantium delectus excepturi, explicabo veritatis officiis error cum eius ut itaque a, mollitia ab ex nihil laboriosam blanditiis voluptatibus reprehenderit."
    ]
  ];

  public static function all(){
    return collect(self::$blog_posts);
  }

  public static function find($slug){
    $posts = static::all();
    
    return $posts->firstWhere('slug', $slug);
  }
}
