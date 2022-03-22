<?php

use App\Http\Controllers\userController;
use App\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/newtask', function () {
//     return view('tasks');
// });
// Route::post('data/{id}', [userController::class, 'getdata']);
// Route::post('/task', function (Request $request) {
//     $validator = Validator::make($request->all(), [
//         'name' => 'required|max:255',
//     ]);

//     if ($validator->fails()) {
//         return redirect('/')
//             ->withInput()
//             ->withErrors($validator);
//     }

//     $task = new task();
//     $task->name = $request->name;
//     $task->save();

//     return redirect('/');
// });
// Route::get('/newtask', function () {
//     $tasks = Task::orderBy('created_at', 'asc')->get();

//     return view('tasks', [
//         'tasks' => $tasks
//     ]);
// });

// Route::delete('/task/{id}', function ($id) {
//     Task::findOrFail($id)->delete();

//     return redirect('/newtask');
// });
// // Route::delete('/task/{id}', [userController::class, 'deletedata']);
// Route::get('user/create', 'userController@createuser');
// Route::post('user/create', 'userController@storeuser');
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');