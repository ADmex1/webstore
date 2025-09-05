<?php

namespace App\Models;

use App\Models\Product;
use Spatie\Tags\Tag as Tagstag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Tagstag
{
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
