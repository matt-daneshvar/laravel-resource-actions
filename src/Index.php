<?php

namespace MattDaneshvar\ResourceActions;

trait Index
{
    use ResourceAction;

    public function index()
    {
        $viewDirectory = $this->getViewDirectory();

        return view("$viewDirectory.index", ['tasks' => $this->getQueryBuilder()->paginate(20)]);
    }
}
