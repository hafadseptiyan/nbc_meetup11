<?php
namespace App\Domain\Author\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;

    protected $table = "authors";
    protected $fillable = ['name','photo','bio'];

}
