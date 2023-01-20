<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetTodosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function get_todos_paginated_list()
    {
        $response = $this->withHeader('Content-Type', 'application/json')->get('/api/todos');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'current_page', 
            'data' => [
                '*' => [
                    'id',
                    'description',
                    'completed',
                    'inserted_at',
                    'updated_at'
                ]
            ], 
            'first_page_url', 
            'from', 
            'last_page', 
            'last_page_url', 
            'links', 
            'next_page_url', 
            'path', 
            'per_page', 
            'prev_page_url', 
            'to', 
            'total'
        ]);
    }
}
