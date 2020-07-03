<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Support\Str;
use MattDaneshvar\ResourceActions\Tests\Utilities\Task;

trait Edit
{
    use ResourceAction;

    public function edit(Task $task)
    {
        $viewDirectory = $this->getViewDirectory();

        $resourceName = Str::lower($this->getResourceName());

        return view("$viewDirectory.edit", [$resourceName => $task]);
    }
}
