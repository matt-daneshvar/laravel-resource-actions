# Laravel Resource Actions

![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/matt-daneshvar/laravel-resource-actions)
[![Build Status](https://travis-ci.org/matt-daneshvar/laravel-resource-actions.svg?branch=master)](https://travis-ci.org/matt-daneshvar/laravel-resource-actions)
![GitHub](https://img.shields.io/github/license/matt-daneshvar/laravel-resource-actions.svg)


If you've built a dozen Laravel apps and if you're anything like me, 
you're tired of rewriting basic CRUD controllers a thousand times. 
This package DRYs up your code by extracting those repetitive actions into a few magical traits. 


## Installation

Require the package using composer:
```
composer require matt-daneshvar/laravel-resource-actions
```

## Usage

Once installed, you can write: 

```php
class TaskController extends BaseController
{
    use Index, Create, Store, Show, Edit, Update, Destroy;

    protected $rules = ['name' => 'required|string|max:250'];
}
```

Instead of: 

```php
class TaskController extends BaseController
{
    protected $rules = ['name' => 'required|string|max:250'];

    public function index()
    {
        return view('task.index', ['tasks' => Task::paginate(20)]);
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate($this->rules);

        Task::create($input);

        return back()->with('success', 'A new task is successfully created.');
    }

    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    public function update(Task $task, Request $request)
    {
        $input = $request->validate($this->rules);

        $task->update($input);

        return back()->with('success', 'The task is successfully updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'The task is successfully deleted.');
    }
}
```

### Index

The `index` action returns the `resource.index` view with a paginated collection of the relevant model,
so that you may write:

```php
class TaskController extends BaseController
{
    use Index;
}
```

Instead of:

```php
class TaskController extends BaseController
{
    public function index()
    {
        return view('task.index', ['tasks' => Task::paginate(20)]);
    }
}
```

### Create

The `create` action returns the `resource.create` view, 
so that you may write:

```php
class TaskController extends BaseController
{
    use Create;
}
```

Instead of:

```php
class TaskController extends BaseController
{
    public function create()
    {
        return view('task.create');
    }
}
```

### Store

The `store` action validates the request against the `$rules`,
persists a new model, 
and redirects back with a success message.
For this action you may write:

```php
class TaskController extends BaseController
{
    use Store;

    protected $rules = ['name' => 'required|string|max:250'];
}
```

Instead of:

```php
class TaskController extends BaseController
{
    protected $rules = ['name' => 'required|string|max:250'];
    
    public function store(Request $request)
    {
        $input = $request->validate($this->rules);

        Task::create($input);

        return back()->with('success', 'A new task is successfully created.');
    }
}
```

### Show

The `show` action returns the `resource.show` view with the relevant model, 
so that you may write:

```php
class TaskController extends BaseController
{
    use Show;
}
```

Instead of:

```php
class TaskController extends BaseController
{
    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }
}
```

### Edit

The `edit` action returns the `resource.edit` view with the relevant model, 
so that you may write:

```php
class TaskController extends BaseController
{
    use Edit;
}
```

Instead of:

```php
class TaskController extends BaseController
{
    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }
}
```

### Update

The `update` action validates the request against the `$rules`,
updates the relevant model, 
and redirects back with a success message.
For this action you may write:

```php
class TaskController extends BaseController
{
    use Update;
    
    protected $rules = ['name' => 'required|string|max:250'];
}
```

Instead of:

```php
class TaskController extends BaseController
{
    protected $rules = ['name' => 'required|string|max:250'];
    
    public function update(Task $task, Request $request)
    {
        $input = $request->validate($this->rules);

        $task->update($input);

        return back()->with('success', 'The task is successfully updated.');
    }
}
```

### Destroy

The `destroy` action deletes the relevant model and redirects back with a success message.
For this action you may write:

```php
class TaskController extends BaseController
{
    use Destroy;
}
```

Instead of:

```php
class TaskController extends BaseController
{
    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'The task is successfully deleted.');
    }
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.