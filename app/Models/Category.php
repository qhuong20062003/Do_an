<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    
    protected $fillable =['name','parent_id','slug'];
    public function categoryChildrent()
{
    return $this->hasMany(Category::class, 'parent_id');
}

}
