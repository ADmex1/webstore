<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Data\ProductData;
use App\Data\ProductCollectionData;
use App\Models\Tag as ModelsTag;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;
    public $queryString = [
        'select_collections' => ['except' => []],
        'sort' => ['except' => 'newest'],
        'search' => ['except' => ''],
    ];
    public array $select_collections = [];
    public string $search = '';
    public string $sort = 'newest';
    public string $sort_by = 'newest';
    public function applyFilter()
    {
        $this->resetPage();
    }
    public function resetFilters()
    {
        $this->select_collections = [];
        $this->sort_by = 'newest';
        $this->search = '';
        $this->resetPage();
    }
    public function render()
    {
        $collection_result = ModelsTag::query()->withType('collection')->withCount('products')->get();
        // $result = Product::paginate(1);
        $query = Product::query();
        if ($this->search) {
            $query->where('name', 'like',   "%{$this->search}%");
        }
        if (!empty($this->select_collections)) {
            $query->whereHas('tags', function ($query) {
                $query->whereIn('id', $this->select_collections);
            });
        }
        switch ($this->sort_by) {
            case 'latest':
                $query->oldest();
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }
        $products = ProductData::collect($query->paginate(6));
        $collections = ProductCollectionData::collect($collection_result);

        return view('livewire.product-catalog', compact('products', 'collections'));
    }
}
