<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $youtube = env('YOUTUBE');

        self::assertEquals('Romi Alief Rahman', $youtube);
    }

    public function testDefaultEnv()
    {
        $author = Env::get('AUTHOR', 'Romi');

        self::assertEquals('Romi', $author);
    }
}
