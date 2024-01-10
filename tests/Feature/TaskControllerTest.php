<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_create_task()
    {
        $data = ['description' => 'New Task'];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201)
            ->assertJson(['description' => 'New Task']);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Task deleted successfully']);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_validation_fails_when_creating_task_with_empty_description()
    {
        $response = $this->postJson('/api/tasks', ['description' => '']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['description']);
    }
}
