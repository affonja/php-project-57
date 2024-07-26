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
        $id = 1;
        return [
            ["/tasks", 200, 'tasks.index'],
            ["/tasks/$id", 200, 'tasks.show'],
            ["/tasks/create", 302],
            ["/tasks/$id/edit", 302]
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
        $response->assertViewHas('task', $this->task);
    }

    public function testStore()
    {
        $task = Task::factory()->make();
        $response = $this->post('/tasks', $task->toArray());
        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
        $response->assertRedirectToRoute('tasks.index');
    }

    public function testShow()
    {
        $response = $this->get("/tasks/{$this->task->id}");
        $response->assertStatus(200);
        $response->assertViewIs('tasks.show');
        $response->assertViewHas('task', $this->task);
    }

    public function testUpdate()
    {
        $updatedData = Task::factory()->make()->only([
            'name', 'description', 'status_id', 'assigned_to_id'
        ]);
        $response = $this->patch("/tasks/{$this->task->id}", $updatedData);
        $this->assertDatabaseHas('tasks', $updatedData);
        $response->assertRedirect('/tasks');
    }

    public function testDestroy()
    {
        $response = $this->delete("/tasks/{$this->task->id}");
        $this->assertDatabaseMissing('tasks', $this->task->toArray());
        $response->assertRedirectToRoute('tasks.index');
    }

    public function testDestroyUnowner()
    {
        $newUser = User::factory()->create();
        $response = $this->actingAs($newUser)->delete("/tasks/{$this->task->id}");
        $response->assertStatus(302);
    }

}
