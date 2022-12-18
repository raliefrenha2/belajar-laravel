<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Romi Alief Rahman');

        $this->get('hello-again')
            ->assertSeeText('Romi Alief Rahman');
    }

    public function testNestedView()
    {
        $this->get('hello-nested')
            ->assertSeeText('Romi Alief Rahman');
    }

    public function testTemplateViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Romi Alief Rahman'])
            ->assertSeeText('Romi Alief Rahman');

            $this->view('nested.hello', ['name' => 'Romi Alief Rahman'])
            ->assertSeeText('Romi Alief Rahman');
    }

}
