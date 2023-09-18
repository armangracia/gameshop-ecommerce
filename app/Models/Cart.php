<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Yajra\DataTables\Html\Editor\Fields\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table ='carts';
    protected $fillable= [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
