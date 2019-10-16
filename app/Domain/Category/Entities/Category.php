<?php
namespace App\Domain\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = "categories";
    protected $fillable = ['name','description'];

}
