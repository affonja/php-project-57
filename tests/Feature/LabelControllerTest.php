<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Label $label;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->label = Label::factory()->create();
    }

    public static function pathProvider(): array
    {
        return [
            ['/labels', 200, 'labels.index'],
            ['/labels/create', 302],
            ['/labels/edit', 302]
        ];
    }

    #[DataProvider('pathProvider')]
    public function testAccessGuest(string $path, int $code, string | null $view = null)
    {
        auth()->logout();
        $response = $this->get($path);
        $response->assertStatus($code);
        if ($view !== null) {
            $response->assertViewIs($view);
            $response->assertViewHas('labels');
        }
    }

    public function testIndex()
    {
        $response = $this->get('/labels');

        $response->assertStatus(200);
        $response->assertViewIs('labels.index');
        $response->assertViewHas('labels');
    }

    public function testCreate()
    {
        $response = $this->get('/labels/create');
        $response->assertStatus(200);
        $response->assertViewIs('labels.create');
    }

    public function testEdit()
    {
        $response = $this->get("/labels/{$this->label->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('labels.edit');
        $response->assertViewHas('label', $this->label);
    }

    public function testStore()
    {
        $label = Label::factory()->make();
        $response = $this->post('/labels', ['name' => $label->name]);

        $this->assertDatabaseHas('labels', ['name' => $label->name]);
        $response->assertRedirectToRoute('labels.index');
    }

    public function testUpdate()
    {
        $updatedData = ['name' => fake()->word];

        $response = $this->patch("/labels/{$this->label->id}", $updatedData);

        $this->assertDatabaseHas('labels', $updatedData);
        $response->assertRedirect('/labels');
    }

    public function testDestroy()
    {
        $response = $this->delete("/labels/{$this->label->id}");

        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
        $response->assertRedirect('/labels');
    }

    public function testDestroyLabelInUse()
    {
        $taskStatus = TaskStatus::factory()->create();
        $task = Task::factory()->create();
        $task->labels()->attach($this->label->id);
        $response = $this->delete("/labels/{$this->label->id}");

        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
        $response->assertRedirect('/labels');
    }

    public function testValidate()
    {
        $validateProvider = [
            ['post', '/labels', []],
            ['patch', "/labels/{$this->label->id}", ['id' => $this->label->id]]
        ];

        foreach ($validateProvider as [$method, $path, $param]) {
            $response = $this->call($method, $path, $param);
            $response->assertStatus(302);
            $response->assertRedirect('/');
            $response->assertSessionHasErrors(['name']);
        }
    }
}
