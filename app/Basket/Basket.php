<?php

namespace App\Basket;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Models\Coupon;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class Basket
{
    protected StorageInterface $storage;
    protected Product $product;

    public function __construct(StorageInterface $storage, Product $product)
    {
        $this->storage = $storage;
        $this->product = $product;
    }

    public function add(Product $product, int $quantity): void
    {
        if ($this->has($product)) {
			$quantity = $this->get($product)['dty'] + $quantity;
		}

		$this->update($product, $quantity);
	}



    public function addCoupon(Coupon $coupon): bool
    {
        if (!$this->checkCoupon($coupon)) {
            return false;
        }

        $product = $coupon->product;
        $existingProduct = $this->get($product);

        $this->storage->set($product->id, [
            'product_id' => $product->id,
            'quantity' => $existingProduct['quantity'],
            'coupon' => $coupon->id,
        ]);

        return true;
    }

    public function checkCoupon(Coupon $coupon): bool
    {
        if (!$this->has($coupon->product)) {
            return false;
        }

        if (!$coupon->active || !$coupon->isValid()) {
            return false;
        }

        $productInCart = $this->get($coupon->product);
        if ($productInCart['quantity'] < $coupon->products_count) {
            return false;
        }

        if ($coupon->members()->find(Auth::guard('site')->id())) {
            return false;
        }

        return true;
    }

    public function checkCouponById(int $id): bool
    {
        $coupon = Coupon::find($id);
        return $coupon ? $this->checkCoupon($coupon) : false;
    }

    public function update(Product $product, int $quantity): void
    {
        if (!$this->product->find($product->id)->hasStock($quantity)) {
            throw new QuantityExceededException;
        }

        if ($quantity === 0) {
            $this->remove($product);
            return;
        }

        $coupon = $this->has($product) ? $this->get($product)['coupon'] : null;

        $this->storage->set($product->id, [
            'product_id' => $product->id,
            'quantity' => $quantity,
            'coupon' => $coupon,
        ]);
    }

    public function remove(Product $product): void
    {
        $this->storage->remove($product->id);
    }

    public function has(Product $product): bool
    {
        return $this->storage->exists($product->id);
    }

    public function get(Product $product): ?array
    {
        return $this->storage->get($product->id);
    }

    public function clear(): void
    {
        $this->storage->clear();
    }

    public function all(): Collection
    {
        $items = collect();
        $ids = array_column($this->storage->all(), 'product_id');

        $products = $this->product->whereIn('id', $ids)->get();

        foreach ($products as $product) {
            $cartItem = $this->get($product);
            $product->quantity = $cartItem['quantity'];
            $product->coupon = $cartItem['coupon'] ?? null;
            $items->push($product);
        }

        return $items;
    }

    public function itemCount(): int
    {
        return count($this->storage->all());
    }

    public function subTotal(): float
    {
        $total = 0;

        foreach ($this->all() as $item) {
            if (!$item->outOfStock()) {
                $total += $item->getTotal(true);
            }
        }

        return $total;
    }

    public function refresh(): void
    {
        foreach ($this->all() as $item) {
            if (!$item->hasStock($item->quantity)) {
                $this->update($item, $item->stock);
            }
        }
    }
}
