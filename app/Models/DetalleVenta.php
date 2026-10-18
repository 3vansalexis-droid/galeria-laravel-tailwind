<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';
    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio_unitario', 'total'];
    protected $casts = ['precio_unitario' => 'decimal:2', 'total' => 'decimal:2'];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
