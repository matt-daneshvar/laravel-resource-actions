<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Create;
use MattDaneshvar\ResourceActions\Index;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class ResourceActionsTest extends BaseCase
{
    /** @test */
    public function multiple_resource_action_traits_can_be_combined_together()
    {
        $controller = new class extends BaseController {
            use Index, Create;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->index())
            ->assertViewIs('task.index');

        $this->getResponse($controller->create())
            ->assertViewIs('task.create');
    }
}
