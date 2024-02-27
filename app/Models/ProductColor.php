<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductColor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productcolor(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'product_color_id');
    }

}
