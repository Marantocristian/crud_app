<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    protected $appends = [
        'is_available',
        'total_value',
        'stock_status'
    ];




    protected function isAvailable(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->quantity > 0,
        );
    }


    protected function totalValue(): Attribute
    {
        return Attribute::make(
            get: fn() => round($this->price * $this->quantity, 2),
        );
    }


    protected function stockStatus(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->quantity === 0) {
                    return 'Sin stock';
                } elseif ($this->quantity < 10) {
                    return 'Stock bajo';
                } elseif ($this->quantity < 50) {
                    return 'Stock medio';
                } else {
                    return 'Stock alto';
                }
            }
        );
    }


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
            set: fn(string $value) => strtolower(trim($value)),
        );
    }




    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('quantity', '>', 0);
    }


    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->where('quantity', '=', 0);
    }


    public function scopeLowStock(Builder $query, int $threshold = 10): Builder
    {
        return $query->where('quantity', '>', 0)
            ->where('quantity', '<=', $threshold);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'ILIKE', "%{$search}%")
                ->orWhere('description', 'ILIKE', "%{$search}%");
        });
    }


    public function scopeMinPrice(Builder $query, float $price): Builder
    {
        return $query->where('price', '>=', $price);
    }


    public function scopeMaxPrice(Builder $query, float $price): Builder
    {
        return $query->where('price', '<=', $price);
    }

    public function scopePriceRange(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('price', [$min, $max]);
    }


    public function scopeExpensive(Builder $query): Builder
    {
        $threshold = self::orderBy('price', 'desc')
            ->limit((int) ceil(self::count() * 0.1))
            ->get()
            ->last()
            ->price ?? 0;

        return $query->where('price', '>=', $threshold);
    }




    public function hasStock(int $quantity = 1): bool
    {
        return $this->quantity >= $quantity;
    }


    public function addStock(int $amount): self
    {
        $this->increment('quantity', $amount);
        return $this;
    }

    /**
     * Reduce el stock del producto
     * 
     * @throws \Exception
     */
    public function reduceStock(int $amount): self
    {
        if (!$this->hasStock($amount)) {
            throw new \Exception("Stock insuficiente. Disponible: {$this->quantity}, Requerido: {$amount}");
        }

        $this->decrement('quantity', $amount);
        return $this;
    }


    public function markAsOutOfStock(): self
    {
        $this->update(['quantity' => 0]);
        return $this;
    }


    public function priceWithDiscount(float $discountPercentage): float
    {
        $discount = ($this->price * $discountPercentage) / 100;
        return round($this->price - $discount, 2);
    }


    public function getFormattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }


    public function getFormattedTotalValue(): string
    {
        return '$' . number_format($this->total_value, 2);
    }


    public function isRunningLow(int $threshold = 10): bool
    {
        return $this->quantity > 0 && $this->quantity <= $threshold;
    }


    public function getSummary(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->getFormattedPrice(),
            'quantity' => $this->quantity,
            'status' => $this->stock_status,
            'total_value' => $this->getFormattedTotalValue(),
            'is_available' => $this->is_available
        ];
    }
}
