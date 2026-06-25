<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_the_tasks_page()
    {
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'Pending'
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Test Task');
    }

    /** @test */
    public function it_can_create_a_task_via_ajax()
    {
        $response = $this->postJson('/tasks', [
            'title' => 'New Task',
            'description' => 'New Description',
            'status' => 'Pending'
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'task' => [
                'title' => 'New Task',
                'description' => 'New Description',
                'status' => 'Pending'
            ]
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task'
        ]);
    }

    /** @test */
    public function it_can_update_task_status_via_ajax()
    {
        $task = Task::create([
            'title' => 'Pending Task',
            'status' => 'Pending'
        ]);

        $response = $this->patchJson("/tasks/{$task->id}/status", [
            'status' => 'In Progress'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'task' => [
                'id' => $task->id,
                'status' => 'In Progress'
            ]
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'In Progress'
        ]);
    }

    /** @test */
    public function it_can_update_task_details_via_ajax()
    {
        $task = Task::create([
            'title' => 'Old Title',
            'description' => 'Old Description',
            'status' => 'Pending'
        ]);

        $response = $this->putJson("/tasks/{$task->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => 'Completed'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'task' => [
                'id' => $task->id,
                'title' => 'Updated Title',
                'description' => 'Updated Description',
                'status' => 'Completed'
            ]
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => 'Completed'
        ]);
    }

    /** @test */
    public function it_can_delete_a_task_via_ajax()
    {
        $task = Task::create([
            'title' => 'Delete Me',
            'status' => 'Pending'
        ]);

        $response = $this->deleteJson("/tasks/{$task->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true
        ]);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
