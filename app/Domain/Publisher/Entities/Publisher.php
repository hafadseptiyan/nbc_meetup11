<?php
namespace App\Domain\Publisher\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Book\Entities\Book;

class Publisher extends Model
{
    use SoftDeletes;

    protected $table = "publishers";
    protected $fillable = ['name','address'];

    public function book(){
        return $this->hasMany(Book::class, 'author_id','id');
    }

}
