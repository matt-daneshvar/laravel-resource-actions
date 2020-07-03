<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Tests\Utilities\TaskController;

class ResourceDiscoveryTest extends BaseCase
{
    /** @test */
    public function resource_name_can_be_automatically_discovered_based_on_controller_name()
    {
        $controller = new TaskController();

        $method = $this->getMethod(TaskController::class, 'getResourceClass');

        $class = $method->invoke($controller);

        $this->assertSame($class, "App\Task");
    }
}
