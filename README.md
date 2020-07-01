# Laravel Resource Actions

Almost any Laravel app would have multiple occurances of basic CRUD actions.
This package DRYs up your code by extracting those repetitive actions into a few magical traits. 


## Usage

```php
<?php

use MattDaneshvar\ResourceActions\Index;
use MattDaneshvar\ResourceActions\Create;
use MattDaneshvar\ResourceActions\Store;
use MattDaneshvar\ResourceActions\Show;

class TaskController extends BaseController {
  use Index, Create, Store, Show;
  
  protected $rules = [
    'name' => 'required|string|max:250'
  ];
}

```

This would be equavilant to: 
```php
<?php

class TaskController extends BaseController {
  protected $rules = [
    'name' => 'required|string|max:250'
  ];

  public function index(){
    return view('task.index', ['tasks' => Task::paginate(20)]);
  }
  
  public function create(){
    return view('task.create');
  }
  
  public function store(Request $request){
    $input = $request->validate($this->rules);
    
    Task::create($input);
    
    return back()->with('success', 'A new task is successfully created.');
  }
  
  public function show(Task $task){
    return view('task.show', ['task' => $task]);
  }
}

```
