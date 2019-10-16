<?php
namespace App\Domain\Publisher\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use SoftDeletes;

    protected $table = "publishers";
    protected $fillable = ['name','address'];

}
