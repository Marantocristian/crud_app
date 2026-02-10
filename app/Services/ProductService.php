<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Obtener productos paginados con filtros opcionales
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedProducts(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Product::query();

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }


        if (!empty($filters['min_price'])) {
            $query->minPrice($filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->maxPrice($filters['max_price']);
        }


        if (isset($filters['in_stock'])) {
            if ($filters['in_stock']) {
                $query->inStock();
            } else {
                $query->outOfStock();
            }
        }


        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    /**
     * Obtener todos los productos
     *
     * @return Collection
     */
    public function getAllProducts(): Collection
    {
        return Product::all();
    }

    /**
     * Encontrar un producto por ID
     *
     * @param int $id
     * @return Product|null
     */
    public function findProduct(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * Crear un nuevo producto
     *
     * @param array $data
     * @return Product
     * @throws \Exception
     */
    public function createProduct(array $data): Product
    {
        try {
            DB::beginTransaction();

            $product = Product::create($data);

            Log::info('Producto creado exitosamente', [
                'product_id' => $product->id,
                'name' => $product->name
            ]);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error al crear producto', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            throw $e;
        }
    }

    /**
     * Actualizar un producto existente
     *
     * @param Product $product
     * @param array $data
     * @return Product
     * @throws \Exception
     */
    public function updateProduct(Product $product, array $data): Product
    {
        try {
            DB::beginTransaction();

            $oldData = $product->toArray();
            $product->update($data);

            Log::info('Producto actualizado exitosamente', [
                'product_id' => $product->id,
                'old_data' => $oldData,
                'new_data' => $data
            ]);

            DB::commit();

            return $product->fresh();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error al actualizar producto', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    /**
     * Eliminar un producto
     *
     * @param Product $product
     * @return bool
     * @throws \Exception
     */
    public function deleteProduct(Product $product): bool
    {
        try {
            DB::beginTransaction();

            $productId = $product->id;
            $productName = $product->name;

            $product->delete();

            Log::info('Producto eliminado exitosamente', [
                'product_id' => $productId,
                'name' => $productName
            ]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error al eliminar producto', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    /**
     * Incrementar la cantidad de un producto
     *
     * @param Product $product
     * @param int $amount
     * @return Product
     */
    public function incrementStock(Product $product, int $amount): Product
    {
        $product->increment('quantity', $amount);

        Log::info('Stock incrementado', [
            'product_id' => $product->id,
            'amount' => $amount,
            'new_quantity' => $product->quantity
        ]);

        return $product->fresh();
    }

    /**
     * Decrementar la cantidad de un producto
     *
     * @param Product $product
     * @param int $amount
     * @return Product
     * @throws \Exception
     */
    public function decrementStock(Product $product, int $amount): Product
    {
        if ($product->quantity < $amount) {
            throw new \Exception('Stock insuficiente para realizar la operación');
        }

        $product->decrement('quantity', $amount);

        Log::info('Stock decrementado', [
            'product_id' => $product->id,
            'amount' => $amount,
            'new_quantity' => $product->quantity
        ]);

        return $product->fresh();
    }

    /**
     * Obtener productos con bajo stock
     *
     * @param int $threshold
     * @return Collection
     */
    public function getLowStockProducts(int $threshold = 10): Collection
    {
        return Product::lowStock($threshold)->get();
    }

    /**
     * Obtener estadísticas de productos
     *
     * @return array
     */
    public function getStatistics(): array
    {
        return [
            'total_products' => Product::count(),
            'in_stock_products' => Product::inStock()->count(),
            'out_of_stock_products' => Product::outOfStock()->count(),
            'total_inventory_value' => Product::sum(DB::raw('price * quantity')),
            'average_price' => Product::avg('price'),
            'total_items_in_stock' => Product::sum('quantity')
        ];
    }

    /**
     * Buscar productos por nombre
     *
     * @param string $searchTerm
     * @return Collection
     */
    public function searchProducts(string $searchTerm): Collection
    {
        return Product::search($searchTerm)->get();
    }

    /**
     * Obtener productos más caros
     *
     * @param int $limit
     * @return Collection
     */
    public function getMostExpensiveProducts(int $limit = 5): Collection
    {
        return Product::orderBy('price', 'desc')->limit($limit)->get();
    }

    /**
     * Obtener productos más baratos
     *
     * @param int $limit
     * @return Collection
     */
    public function getCheapestProducts(int $limit = 5): Collection
    {
        return Product::orderBy('price', 'asc')->limit($limit)->get();
    }
}
