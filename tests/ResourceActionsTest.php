<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Create;
use MattDaneshvar\ResourceActions\Index;
use MattDaneshvar\ResourceActions\ResourceActions;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class ResourceActionsTest extends BaseCase
{
    /** @test */
    public function it_may_be_used_as_an_alias_to_include_all_seven_resource_actions()
    {
        $controller = new class extends BaseController {
            use ResourceActions;
        };

        $this->assertTrue(method_exists($controller, 'index'));
        $this->assertTrue(method_exists($controller, 'create'));
        $this->assertTrue(method_exists($controller, 'store'));
        $this->assertTrue(method_exists($controller, 'show'));
        $this->assertTrue(method_exists($controller, 'edit'));
        $this->assertTrue(method_exists($controller, 'update'));
        $this->assertTrue(method_exists($controller, 'destroy'));
    }

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
