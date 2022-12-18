<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/test')
            ->assertStatus(200)
            ->assertSeeText('Romi Alief Rahman');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/test');
    }

    public function testFallback()
    {
        $this->get('/tidakadaroutenya')
            ->assertSee('404 by ai.romi');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Produk 1');

        $this->get('/products/2')
            ->assertSeeText('Produk 2');

        $this->get('/products/1/items/ABC')
            ->assertSeeText('Produk 1, item ABC');

        $this->get('/products/2/items/DEF')
            ->assertSeeText('Produk 2, item DEF');
    }

    public function testRouteParameterWithValidation()
    {
        $this->get('/categories/100')
            ->assertSeeText('Kategori 100');

        $this->get('/categories/abc')
            ->assertSeeText('404 by ai.romi');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/romi')
            ->assertSeeText('User romi');

        $this->get('users/')
            ->assertSeeText('User 404');
    }
}
