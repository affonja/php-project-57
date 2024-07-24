<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use PHPUnit\Framework\Attributes\DataProvider;


class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $users = User::factory()->count(5)->create();
        $taskStatuses = TaskStatus::factory()->count(5)->create();
        $this->actingAs($users->random());
        $this->task = Task::factory()->create();
    }

    public static function pathProvider(): array
    {
        return [
            ['/tasks', 200, 'tasks.index'],
            ['/tasks/create', 302],
            ['/tasks/edit', 302]
        ];
    }

    #[DataProvider('pathProvider')]
    public function testAccessGuest($path, $code, $view = null)
    {
        auth()->logout();
        $response = $this->get($path);
        $response->assertStatus($code);
        if ($path === '/tasks') {
            $response->assertViewIs($view);
            $response->assertViewHas('tasks');
        }
    }

    public function testIndex()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
    }

    public function testCreate()
    {
        $response = $this->get('/tasks/create');
        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
    }

    public function testEdit()
    {
        $response = $this->get("/tasks/{$this->task->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('tasks.edit');
        $response->assertViewHas('tasks', $this->task);
    }

    public function testStore()
    {
        $taskData = Task::factory()->make()->toArray();
        $response = $this->post('/tasks', $taskData);
        $response->assertDatabaseHas('tasks', $taskData);
        $response->assertRedirectToRoute('tasks.index');
    }

    public function testUpdate()
    {
        $updatedData = Task::factory()->make()->toArray();
        $response = $this->patch("/tasks/{$this->task->id}", $updatedData);
        $response->assertDatabaseHas('tasks', $updatedData);
        $response->assertRedirectToRoute('tasks.index');
    }

    public function testDestroy()
    {
        $response = $this->delete("/tasks/{$this->task->id}");
        $response->assertDatabaseMissing('tasks', $this->task->toArray());
        $response->assertRedirectToRoute('tasks.index');
    }

}
