<?php
namespace App\Domain\Author\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Book\Entities\Book;

class Author extends Model
{
    use SoftDeletes;

    protected $table = "authors";
    protected $fillable = ['name','photo','bio'];

    public function book(){
        return $this->hasMany(Book::class, 'author_id','id');
    }

}
