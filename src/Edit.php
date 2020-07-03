<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Support\Str;

trait Edit
{
    use ResourceAction;

    public function edit($key)
    {
        $model = $this->getResource()->resolveRouteBinding($key);

        $viewDirectory = $this->getViewDirectory();

        $resourceName = Str::lower($this->getResourceName());

        return view("$viewDirectory.edit", [$resourceName => $model]);
    }
}
