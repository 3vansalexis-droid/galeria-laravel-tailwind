<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VentaTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_sale_decreases_product_stock(): void
    {
        [$cliente, $producto] = $this->salesData(3);

        $response = $this->post(route('ventas.store'), [
            'cliente_id' => $cliente->id,
            'fecha_venta' => '2026-10-18',
            'estado' => 'confirmada',
            'detalles' => [
                ['producto_id' => $producto->id, 'cantidad' => 2],
            ],
        ]);

        $response->assertRedirect(route('ventas.index'));
        $this->assertDatabaseHas('productos', ['id' => $producto->id, 'stock' => 1]);
        $this->assertDatabaseHas('ventas', ['cliente_id' => $cliente->id, 'estado' => 'confirmada', 'total' => '20.00']);
    }

    public function test_a_sale_cannot_exceed_product_stock(): void
    {
        [$cliente, $producto] = $this->salesData(1);

        $this->from(route('ventas.index'))
            ->post(route('ventas.store'), [
                'cliente_id' => $cliente->id,
                'fecha_venta' => '2026-10-18',
                'estado' => 'confirmada',
                'detalles' => [
                    ['producto_id' => $producto->id, 'cantidad' => 2],
                ],
            ])
            ->assertRedirect(route('ventas.index'))
            ->assertSessionHasErrors('detalles');

        $this->assertDatabaseCount('ventas', 0);
        $this->assertDatabaseHas('productos', ['id' => $producto->id, 'stock' => 1]);
    }

    public function test_confirmed_sales_cannot_be_deleted(): void
    {
        [$cliente, $producto] = $this->salesData(2);
        $venta = $cliente->ventas()->create([
            'fecha_venta' => '2026-10-18',
            'estado' => 'confirmada',
            'total' => 10,
        ]);
        $venta->detalles()->create([
            'producto_id' => $producto->id,
            'cantidad' => 1,
            'precio_unitario' => 10,
            'total' => 10,
        ]);

        $this->delete(route('ventas.destroy', $venta))
            ->assertRedirect(route('ventas.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('ventas', ['id' => $venta->id]);
    }

    private function salesData(int $stock): array
    {
        $categoria = Categoria::create(['categoria' => 'General']);
        $cliente = Cliente::create([
            'nombre' => 'Cliente de prueba',
            'email' => uniqid('cliente-', true) . '@example.com',
            'direccion' => 'Dirección de prueba',
            'telefono' => '5555555555',
        ]);
        $producto = Producto::create([
            'producto' => 'Producto de prueba',
            'precio' => 10,
            'stock' => $stock,
            'categoria_id' => $categoria->id,
        ]);

        return [$cliente, $producto];
    }
}
