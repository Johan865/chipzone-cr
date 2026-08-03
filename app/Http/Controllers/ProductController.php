<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\RecentlyViewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    private const RECENT_COOKIE = 'recently_viewed_ids';
    private const RECENT_LIMIT = 8;

    public function index(Request $request)
    {
        $products = Product::query()
            ->where('active', true)
            ->when($request->filled('categoria'), function ($q) use ($request) {
                $q->whereHas('category', fn ($c) => $c->where('slug', $request->query('categoria')));
            })
            ->search($request->query('q'))
            ->priceBetween($request->query('min'), $request->query('max'))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'recentlyViewed' => $this->getRecentlyViewedProducts($request),
        ]);
    }

    public function show(Request $request, Product $product)
    {
        $this->registerRecentlyViewed($request, $product);

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'related' => $related,
        ]);
    }

    /**
     * Guarda el producto visto en una cookie (para invitados y usuarios)
     * y además en la tabla recently_viewed si hay sesión iniciada.
     */
    private function registerRecentlyViewed(Request $request, Product $product): void
    {
        $ids = $this->getRecentIdsFromCookie($request);

        $ids = array_values(array_unique(array_merge([$product->id], $ids)));
        $ids = array_slice($ids, 0, self::RECENT_LIMIT);

        Cookie::queue(self::RECENT_COOKIE, implode(',', $ids), 60 * 24 * 30); // 30 días

        if ($request->user()) {
            RecentlyViewed::updateOrCreate(
                ['user_id' => $request->user()->id, 'product_id' => $product->id],
                ['viewed_at' => now()]
            );
        }
    }

    private function getRecentIdsFromCookie(Request $request): array
    {
        $raw = $request->cookie(self::RECENT_COOKIE, '');
        return $raw ? array_filter(explode(',', $raw)) : [];
    }

    private function getRecentlyViewedProducts(Request $request)
    {
        if ($request->user()) {
            return RecentlyViewed::where('user_id', $request->user()->id)
                ->with('product')
                ->orderByDesc('viewed_at')
                ->limit(self::RECENT_LIMIT)
                ->get()
                ->pluck('product')
                ->filter();
        }

        $ids = $this->getRecentIdsFromCookie($request);

        return $ids
            ? Product::whereIn('id', $ids)->get()->sortBy(fn ($p) => array_search($p->id, $ids))->values()
            : collect();
    }
}
