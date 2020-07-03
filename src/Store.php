<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Store
{
    use ResourceActionBase;

    public function store(Request $request)
    {
        $input = $request->validate($this->rules ?? []);

        $this->getResource()->create($input);

        $resourceName = Str::lower($this->getResourceName());

        return back()->with('success', "A new $resourceName is successfully created.");
    }
}
