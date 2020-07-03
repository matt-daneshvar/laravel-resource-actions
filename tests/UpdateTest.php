<?php

namespace MattDaneshvar\ResourceActions\Tests;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;
use MattDaneshvar\ResourceActions\Update;

class UpdateTest extends BaseCase
{
    /** @test */
    public function it_validates_the_request()
    {
        $task = $this->createTasks(1)->first();

        $controller = new class extends BaseController {
            use Update;

            protected $rules = ['name' => 'required|string|max:1'];

            protected $resource = Task::class;
        };

        $this->expectException(ValidationException::class);

        $controller->update($task, new Request(['name' => 'long name']));
    }

    /** @test */
    public function it_updates_the_relevant_model()
    {
        $task = $this->createTasks(1)->first();

        $controller = new class extends BaseController {
            use Update;

            protected $rules = ['name' => 'required'];

            protected $resource = Task::class;
        };

        $controller->update($task->id, new Request(['name' => 'new name']));

        $this->assertEquals('new name', $task->fresh()->name);
    }

    /** @test */
    public function it_redirects_back_with_a_success_message()
    {
        $task = $this->createTasks(1)->first();

        $controller = new class extends BaseController {
            use Update;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->update($task->id, new Request(['name' => 'buy groceries'])))
            ->assertRedirect()
            ->assertSessionHas('success');
    }
}
