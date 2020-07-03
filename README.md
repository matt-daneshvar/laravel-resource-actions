# Laravel Resource Actions

[![Build Status](https://travis-ci.org/matt-daneshvar/laravel-resource-actions.svg?branch=master)](https://travis-ci.org/matt-daneshvar/laravel-resource-controller)
![GitHub](https://img.shields.io/github/license/matt-daneshvar/laravel-resource-actions.svg)

Almost any Laravel app would have multiple occurances of basic CRUD actions.
This package DRYs up your code by extracting those repetitive actions into a few magical traits. 

## Usage

This package helps you write: 

```php
class TaskController extends BaseController {
  use Index, Create, Store, Show, Edit, Update, Destroy;
  
  protected $rules = [
    'name' => 'required|string|max:250'
  ];
}

```

Instead of: 

```php
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
  
  public function edit(Task $task){
    return view('task.edit', ['task' => $task]);
  }
  
  public function update(Task $task, Request $request){
    $input = $request->validate($this->rules);
    
    $task->update($input);
    
    return back()->with('success', 'The task is successfully updated.');
  }
  
  public function destroy(Task $task){
    $task->delete();
    
    return back()->with('success', 'The task is successfully deleted.');
  }
}

```
