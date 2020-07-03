<?php

namespace MattDaneshvar\ResourceActions\Tests;

use MattDaneshvar\ResourceActions\Destroy;
use MattDaneshvar\ResourceActions\Tests\Utilities\BaseController;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

class DestroyTest extends BaseCase
{
    /** @test */
    public function it_deletes_the_relevant_model()
    {
        $task = $this->createTasks(1)->first();

        $controller = new class extends BaseController {
            use Destroy;

            protected $resource = Task::class;
        };

        $controller->destroy($task->id);

        $this->assertDatabaseCount('tasks', 0);
    }

    /** @test */
    public function it_redirects_back_with_a_success_message()
    {
        $task = $this->createTasks(1)->first();

        $controller = new class extends BaseController {
            use Destroy;

            protected $resource = Task::class;
        };

        $this->getResponse($controller->destroy($task->id))
            ->assertRedirect()
            ->assertSessionHas('success');
    }
}
