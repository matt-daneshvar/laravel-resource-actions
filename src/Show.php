<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Support\Str;

trait Show
{
    use ResourceAction;

    public function show($key)
    {
        $model = $this->getResource()->resolveRouteBinding($key);

        $viewDirectory = $this->getViewDirectory();

        $resourceName = Str::lower($this->getResourceName());

        return view("$viewDirectory.show", [$resourceName => $model]);
    }
}
