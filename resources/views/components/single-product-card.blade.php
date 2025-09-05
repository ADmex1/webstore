<a class="flex flex-col bg-white group rounded-xl dark:border-neutral-900 dark:shadow-neutral-700/70"
    href="{{ route('product') }}">
    <img class="object-cover rounded-md aspect-square" src="{{ $product->cover_url }}" alt="{{ $product->name }}" />
    <div class="py-5">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
            {{ $product->name }}
        </h3>
        <span class="text-sm text-gray-900">
            {{ $product->tags }}
        </span>
        <p class="mt-1 font-semibold text-black dark:text-black">
            {{ $product->price_format }}
        </p>
    </div>
</a>
