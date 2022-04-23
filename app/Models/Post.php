<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
  use HasFactory, Sluggable;

  // yang boleh diisi
  // protected $fillable = ['title', 'category_id', 'slug', 'excerpt', 'body'];
  // yang tidak boleh diisi
  protected $guarded = ['id'];

  protected $with = ['author', 'category'];

  public function scopeFilter($query, array $filters){
    // cara 1 SEARCH
    // if(isset($filters['search']) ? $filters['search'] : false){
    //   return $query->where('title', 'like', '%' . $filters['search'] . '%')
    //                 ->orWhere('body', 'like', '%' . $filters['search'] . '%');
    // }

    // cara 2 SEARCH
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
    });

    // SEARCH BY CATEGORY
    $query->when($filters['category'] ?? false, function ($query, $category){
      return $query->whereHas('category', function($query) use ($category){
        $query->where('slug', $category);
      });
    });

    // SEARCH BY AUTHOR
    $query->when($filters['author'] ?? false, function ($query, $author){
      return $query->whereHas('author', function($query) use ($author){
        $query->where('username', $author);
      });
    });
  }

  public function category() {
    // 1 postingan mempunyai 1 kategori
    return $this->belongsTo(Category::class);
  }

  public function author(){
    return $this->belongsTo(User::class, 'user_id');
  }

  // id ditimpa slug
  public function getRouteKeyName(){
    return 'slug';
  }

  public function sluggable(): array{
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }
}
