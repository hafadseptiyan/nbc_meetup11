<?php
namespace App\Domain\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Category\Entities\Category;
use App\Domain\Author\Entities\Author;
use App\Domain\Publisher\Entities\Publisher;
// use App\Domain\Language\Entities\Language;

class Book extends Model
{
    use SoftDeletes;

    protected $table = "books";
    protected $fillable = ['cover','name','description','published_year',
    'category_id','author_id','language_id','publisher_id'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    // public function language(){
    //     return $this->belongsTo(Language::class, 'language_id', 'id');
    // }

}
