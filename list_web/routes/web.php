<?php

use App\Http\Controllers\TaskController;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Models\Task;

Route::resource('/tasks', TaskController::class);

Route::put('/tasks/{task}/toggle-complete', [TaskController::class, 'toggleTaskComplete'])
  ->name('tasks.toggleComplete');

Route::fallback(function () {
    return redirect()->route('tasks.index');
});



// Route::get('/tasks', function() {
//     return view('index', [
//       //'tasks' => App\Models\Task::all()
//       'tasks' => Task::latest()->paginate(10)
//     ]);
// })->name('tasks.index');

// Route::view('/tasks/create', 'create')->name('tasks.create');

// Route::get('/tasks/{task}/edit', function(Task $task) {
//     return view('edit', [
//       'task' => $task
//     ]);
// })->name('tasks.edit');

// Route::get('/tasks/{task}', function(Task $task) {
//     return view('show', [
//       'task' => $task
//     ]);
// })->name('tasks.show');

// Route::post('/tasks', function(TaskRequest $request){
//     $task = Task::create($request->validated());

//     return redirect()->route('tasks.show', $task)
//             ->with('success', 'task created successful');
// })->name('tasks.store');

// Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
//     $task->update($request->validated());

//     return redirect()->route('tasks.show', $task)
//             ->with('success', 'task updated successful');
// })->name('tasks.update');

// Route::delete('/tasks/{task}', function(Task $task){
//   $task->delete();

//   return redirect()->route('tasks.index')
//           ->with('success', 'delete is successful');
// })->name('tasks.destory');