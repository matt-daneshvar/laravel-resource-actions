<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Index;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class IndexTest extends BaseCase
{
    /** @test */
    public function it_returns_the_index_view()
    {
        $controller = new class extends BaseController {
            use Index;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->index())
            ->assertViewIs('task.index')
            ->assertViewHas('tasks');
    }

    /** @test */
    public function it_paginates_the_resource()
    {
        $this->createTasks(25);

        $controller = new class extends BaseController {
            use Index;

            protected $resource = Task::class;
        };

        $response = $this->getResponse($controller->index());

        $this->assertCount(20, $response->viewData('tasks'));
    }
}
