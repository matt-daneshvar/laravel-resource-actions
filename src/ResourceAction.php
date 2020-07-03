<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Support\Str;

trait ResourceAction
{
    protected function getViewDirectory()
    {
        return Str::lower($this->getResourceName());
    }

    protected function getQueryBuilder()
    {
        $class = $this->getResourceClass();

        return (new $class)->query();
    }

    protected function getResourceName()
    {
        return class_basename($this->getResourceClass());
    }

    protected function getResourceClass()
    {
        return $this->resource;
    }
}
