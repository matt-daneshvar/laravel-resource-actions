<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Support\Str;

trait Index
{
    use ResourceActionBase;

    public function index()
    {
        $viewDirectory = $this->getViewDirectory();

        $pluralResourceName = Str::lower(Str::plural($this->getResourceName()));

        return view("$viewDirectory.index", [$pluralResourceName => $this->getResource()->paginate(20)]);
    }
}
