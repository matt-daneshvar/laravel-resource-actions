<?php

namespace MattDaneshvar\ResourceActions\Tests;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use MattDaneshvar\ResourceActions\Store;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class StoreTest extends BaseCase
{
    /** @test */
    public function it_validates_the_request()
    {
        $controller = new class extends BaseController {
            use Store;

            protected $rules = ['name' => 'required|string|max:1'];

            protected $resource = Task::class;
        };

        $this->expectException(ValidationException::class);

        $controller->store(new Request(['name' => 'long name']));
    }

    /** @test */
    public function it_persists_a_new_model()
    {
        $controller = new class extends BaseController {
            use Store;

            protected $rules = ['name' => 'required'];

            protected $resource = Task::class;
        };

        $controller->store(new Request(['name' => 'buy groceries']));

        $this->assertDatabaseCount('tasks', 1);
    }

    /** @test */
    public function it_redirects_back_with_a_success_message()
    {
        $controller = new class extends BaseController {
            use Store;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->store(new Request(['name' => 'buy groceries'])))
            ->assertRedirect()
            ->assertSessionHas('success');
    }
}
