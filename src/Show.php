<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Support\Str;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

trait Show
{
    use ResourceAction;

    public function show(Task $task)
    {
        $viewDirectory = $this->getViewDirectory();

        $resourceName = Str::lower($this->getResourceName());

        return view("$viewDirectory.show", [$resourceName => $task]);
    }
}
