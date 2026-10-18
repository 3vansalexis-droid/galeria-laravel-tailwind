<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'producto',
        'precio',
        'stock',
        'categoria_id',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
