<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    //pode ter problema aqui

    public function products()
    {
        return $this->hasMany(Product::class, 'categoria_id', 'id');
    }

    protected static function booted()
    {
        self::deleting(function (Category $category) {
            $category->products()->each(function ($product) {
                $product->delete();
            });
        });
    }
}
