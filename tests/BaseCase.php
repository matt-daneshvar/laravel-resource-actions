<?php

namespace MattDaneshvar\ResourceActions\Tests;

use Illuminate\Database\Eloquent\Collection;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;
use Orchestra\Testbench\TestCase;
use ReflectionClass;

abstract class BaseCase extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->loadViewsFrom(__DIR__.'/resources/views');
    }

    /**
     * Load views from the given path.
     *
     * @param $path
     */
    protected function loadViewsFrom($path)
    {
        $this->app['view']->addLocation($path);
    }

    /**
     * Create n dummy tasks.
     *
     * @param  int  $n
     * @return \Illuminate\Support\Collection $tasks
     */
    protected function createTasks($n = 1)
    {
        $tasks = new Collection();
        for ($i = 1; $i <= $n; $i++) {
            $tasks->add(Task::create(['name' => "Task $i"]));
        }

        return $tasks;
    }

    /**
     * Create a test response instance from the given response.
     *
     * @param  \Illuminate\Http\Response  $response
     * @return \Illuminate\Testing\TestResponse
     */
    protected function getResponse($response)
    {
        $testResponse = $this->createTestResponse($response);

        $testResponse->original = $response;

        return $testResponse;
    }

    /**
     * Get access to invokable method regardless of its access level.
     *
     * @param $class
     * @param $name
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    protected function getMethod($class, $name)
    {
        $class = new ReflectionClass($class);

        $method = $class->getMethod($name);

        $method->setAccessible(true);

        return $method;
    }
}
