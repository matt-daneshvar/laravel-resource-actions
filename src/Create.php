<?php

namespace MattDaneshvar\ResourceActions;

trait Create
{
    use ResourceAction;

    public function create()
    {
        $viewDirectory = $this->getViewDirectory();

        return view("$viewDirectory.create", ['tasks' => $this->getQueryBuilder()->paginate(20)]);
    }
}
