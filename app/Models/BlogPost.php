<?php

namespace App\Models;

use App\Models\BlogCategory;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(BlogCategory::class,'blogcat_id','id');

    }

}
