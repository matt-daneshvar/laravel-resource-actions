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
        if (isset($this->resouce)) {
            return $this->resource;
        }

        $classBasename = str_replace('Controller', '', class_basename($this));

        $classNameWithModelFolder = "App\Models\\$classBasename";

        return class_exists($classNameWithModelFolder) ? $classNameWithModelFolder : "App\\$classBasename";
    }
}
