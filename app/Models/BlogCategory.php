<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

     /**
     * @return HasMany
     */
    public function blogs()
    {
        return $this->hasMany(BlogPost::class);
    }
}
