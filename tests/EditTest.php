<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Edit;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class EditTest extends BaseCase
{
    /** @test */
    public function it_returns_the_edit_view()
    {
        $task = $this->createTasks(1)->first();

        $controller = new class extends BaseController {
            use Edit;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->edit($task))
            ->assertViewIs('task.edit')
            ->assertViewHas('task');
    }
}
