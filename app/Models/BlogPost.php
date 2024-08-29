<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPost extends Model
{
    use HasFactory;

    protected $guarded = [];

     /**
     * @return BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
