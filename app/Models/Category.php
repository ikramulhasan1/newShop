<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    use Sluggable;

    protected $guarded = [];

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name', // Replace 'name' with the actual column you want to use for generating the slug
            ],
        ];
    }
}
