<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index', [
        'tasks'=> Task::latest()->get()
    ]);
})->name('tasks.index');


Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task){
    return view('edit', ['task'=>$task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task){
    return view('show', ['task'=>$task]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request){
    $data = $request->validate([
       'title'=>'required|max:255',
       'description'=>'required',
       'long_description'=>'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description=$data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id'=>$task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, Request $request){
    $data = $request->validate([
        'title'=>'required|max:255',
        'description'=>'required',
        'long_description'=>'required'
    ]);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description=$data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id'=>$task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::fallback(function(){
    return 'Still got somewhere!';
});

