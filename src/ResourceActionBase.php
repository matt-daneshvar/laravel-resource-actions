<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Support\Str;

trait ResourceActionBase
{
    protected function getViewDirectory()
    {
        return Str::lower($this->getResourceName());
    }

    protected function getResource()
    {
        $class = $this->getResourceClass();

        return new $class;
    }

    protected function getResourceName()
    {
        return class_basename($this->getResourceClass());
    }

    protected function getResourceClass()
    {
        if (isset($this->resource)) {
            return $this->resource;
        }

        $classBasename = str_replace('Controller', '', class_basename($this));

        $classNameWithModelFolder = "App\Models\\$classBasename";

        return class_exists($classNameWithModelFolder) ? $classNameWithModelFolder : "App\\$classBasename";
    }
}
