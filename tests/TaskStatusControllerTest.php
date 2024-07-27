<?php

namespace Tests;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->taskStatus = TaskStatus::factory()->create();
    }

    public static function pathProvider(): array
    {
        return [
            ['/task_statuses', 200, 'taskStatuses.index'],
            ['/task_statuses/create', 302],
            ['/task_statuses/edit', 302]
        ];
    }

    #[DataProvider('pathProvider')]
    public function testAccessGuest($path, $code, $view = null)
    {
        auth()->logout();
        $response = $this->get($path);
        $response->assertStatus($code);
        if ($view) {
            $response->assertViewIs($view);
            $response->assertViewHas('taskStatuses');
        }
    }

    public function testIndex()
    {
        $response = $this->get('/task_statuses');

        $response->assertStatus(200);
        $response->assertViewIs('taskStatuses.index');
        $response->assertViewHas('taskStatuses');
    }

    public function testCreate()
    {
        $response = $this->get('/task_statuses/create');
        $response->assertStatus(200);
        $response->assertViewIs('taskStatuses.create');
    }

    public function testEdit()
    {
        $response = $this->get("/task_statuses/{$this->taskStatus->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('taskStatuses.edit');
        $response->assertViewHas('taskStatus', $this->taskStatus);
    }

    public function testStore()
    {
        $taskStatus = TaskStatus::factory()->make();
        $response = $this->post('/task_statuses', ['name' => $taskStatus->name]);

        $this->assertDatabaseHas('task_statuses', ['name' => $taskStatus->name]);
        $response->assertRedirectToRoute('task_statuses.index');
    }

    public function testUpdate()
    {
        $updatedData = ['name' => fake()->word];

        $response = $this->patch("/task_statuses/{$this->taskStatus->id}", $updatedData);

        $this->assertDatabaseHas('task_statuses', $updatedData);
        $response->assertRedirect('/task_statuses');
    }

    public function testDestroy()
    {
        $response = $this->delete("/task_statuses/{$this->taskStatus->id}");

        $this->assertDatabaseMissing('task_statuses', ['id' => $this->taskStatus->id]);
        $response->assertRedirect('/task_statuses');
    }

    public function testDestroyTaskStatusInUse()
    {
        $task = Task::factory()->create(['status_id' => $this->taskStatus->id]);
        $response = $this->delete("/task_statuses/{$this->taskStatus->id}");

        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
        $response->assertRedirect('/task_statuses');
    }

    public function testValidate()
    {
        $validateProvider = [
            ['post', '/task_statuses', ['name' => $this->taskStatus->name]],
            ['patch', "/task_statuses/{$this->taskStatus->id}", ['name' => $this->taskStatus->name]]
        ];

        foreach ($validateProvider as [$method, $path, $param]) {
            $response = $this->$method($path, $param);
            $response->assertStatus(302);
            $response->assertRedirect('/');
            $flashMessages = session('flash_notification');
            $this->assertStringContainsString('name с таким именем уже существует', $flashMessages[0]['message']);
        }
    }
}
