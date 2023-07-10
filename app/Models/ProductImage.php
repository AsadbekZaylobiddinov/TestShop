<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class)->onDelete('cascade');


    }
        protected static function booted(): void
    {
        static::deleted(function (ProductImage $productImage) {
            Storage::delete($productImage->path);
        });
    }
}
