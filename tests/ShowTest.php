<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Show;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class ShowTest extends BaseCase
{
    /** @test */
    public function it_returns_the_show_view()
    {
        $task = $this->createTasks(1)->first();

        $controller = new class extends BaseController {
            use Show;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->show($task))
            ->assertViewIs('task.show')
            ->assertViewHas('task');
    }
}
