<?php

namespace MattDaneshvar\ResourceActions;

trait Destroy
{
    use ResourceAction;

    public function destroy($key)
    {
        $model = $this->getResource()->resolveRouteBinding($key);

        $model->delete();

        $resourceName = $this->getResourceName();

        return back()->with('success', "$resourceName is successfully deleted.");
    }
}
