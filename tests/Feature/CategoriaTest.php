<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_categories_page_is_available(): void
    {
        $this->get('/categorias')
            ->assertOk()
            ->assertSee('Guardar');
    }

    public function test_a_category_can_be_created_from_the_web_form(): void
    {
        $this->from('/categorias')
            ->post('/categorias', ['categoria' => 'Naturaleza'])
            ->assertRedirect('/categorias')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categoria', ['categoria' => 'Naturaleza']);
    }

    public function test_a_category_requires_a_name(): void
    {
        $this->post('/categorias', ['categoria' => ''])
            ->assertSessionHasErrors('categoria');

        $this->assertDatabaseCount('categoria', 0);
    }

    public function test_a_category_can_be_updated(): void
    {
        $categoria = Categoria::create(['categoria' => 'Antigua']);

        $this->put(route('categorias.update', $categoria), ['categoria' => 'Actualizada'])
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categoria', ['id' => $categoria->id, 'categoria' => 'Actualizada']);
    }

    public function test_a_category_can_be_deleted(): void
    {
        $categoria = Categoria::create(['categoria' => 'Temporal']);

        $this->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('categoria', ['id' => $categoria->id]);
    }
}
