<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Product;
use Illuminate\Support\Number;
use Illuminate\Support\Optional;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Data;
use Ramsey\Uuid\Type\Integer;

class ProductData extends Data
{
    #[Computed]
    public string $price_format;
    public function __construct(
        public string $name,
        public string $sku,
        public string $slug,
        public string|Optional|null $description,
        public int $stock,
        public float $price,
        public string $tags,
        public string $cover_url
    ) {
        $this->price_format  = Number::currency($price);
    }
    public static function fromModel(Product $product): self
    {
        return new self(
            $product->name,
            $product->sku,
            $product->slug,
            $product->description,
            $product->stock,
            floatval($product->price),
            $product->tags()->where('type', 'collection')->pluck('name')->implode(', '),
            $product->getFirstMediaUrl('Cover')
        );
    }
}
