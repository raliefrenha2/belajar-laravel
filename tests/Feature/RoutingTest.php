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
}
