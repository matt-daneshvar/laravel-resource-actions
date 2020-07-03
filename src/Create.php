<?php

namespace MattDaneshvar\ResourceActions;

trait Create
{
    use ResourceActionBase;

    public function create()
    {
        $viewDirectory = $this->getViewDirectory();

        return view("$viewDirectory.create");
    }
}
