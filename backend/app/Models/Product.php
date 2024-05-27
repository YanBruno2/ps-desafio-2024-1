<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Product extends Model
{
    use HasFactory, HasUuids;

    //campos que não vão ser alterados
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'image',
        'categoria_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id', 'id');
    }

    protected static function booted()
    {
        self::deleted(function (Product $product) {
            try {
                $image_name = explode('products/', $product['image']);
                Storage::disk('public')->delete('products/'.$image_name[1]); //alterar de novo para products
            } catch (Throwable) {
            }
        });
    }
}
