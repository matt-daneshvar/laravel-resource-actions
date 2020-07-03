<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Create;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class CreateTest extends BaseCase
{
    /** @test */
    public function it_returns_the_create_view()
    {
        $controller = new class extends BaseController {
            use Create;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->create())
            ->assertViewIs('task.create')
            ->assertViewHas('tasks');
    }
}
