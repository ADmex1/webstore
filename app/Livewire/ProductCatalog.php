<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Data\ProductData;
use App\Data\ProductCollectionData;
use App\Models\Tag as ModelsTag;

class ProductCatalog extends Component
{
    public function render()
    {
        $collection_result = ModelsTag::query()->withType('collection')->withCount('products')->get();
        $result = Product::paginate(1);

        $products = ProductData::collect($result);
        $collections = ProductCollectionData::collect($collection_result);

        return view('livewire.product-catalog', compact('products', 'collections'));
    }
}
