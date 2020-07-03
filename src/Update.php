<?php

namespace MattDaneshvar\ResourceActions;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Update
{
    use ResourceAction;

    public function update($key, Request $request)
    {
        $model = $this->getResource()->resolveRouteBinding($key);

        $input = $request->validate($this->rules ?? []);

        $model->update($input);

        $resourceName = Str::lower($this->getResourceName());

        return back()->with('success', "A new $resourceName is successfully updated.");
    }
}
