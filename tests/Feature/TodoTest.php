<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Todo;

class GetTodosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_todos_paginated_list()
    {
        $todo = Todo::factory(1000)->create();

        $response = $this->withHeader('Content-Type', 'application/json')->get('/api/todos');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'current_page', 
            'data' => [
                '*' => [
                    'id',
                    'description',
                    'completed',
                    'created_at',
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

    public function test_patch_update_todo_item()
    {
        $todo = Todo::factory()->create();

        $payload = [
            'completed' => true
        ];

        $response = $this->withHeader('Content-Type', 'application/json')
                         ->patchJson('/api/todos/'.$todo->id, $payload);

        $response->assertStatus(200);

        $response->assertExactJson([
            'id' => $todo->id,
            'description' => $todo->description,
            'completed' => $payload['completed'],
            'created_at' => $todo->created_at,
            'updated_at' => $todo->updated_at
        ]);
    }
}
