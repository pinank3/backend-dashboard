<?php
Route::get('/', function() {
    return redirect(route('admin.dashboard'));
});

Route::get('home', function() {
    return redirect(route('admin.dashboard'));
});

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function() {
    Route::get('dashboard', 'DashboardController')->name('dashboard');

    Route::get('users/roles', 'UserController@roles')->name('users.roles');
    Route::resource('users', 'UserController', [
        'names' => [
            'index' => 'users'
        ]
    ]);
});

Route::middleware('auth')->get('logout', function() {
    Auth::logout();
    return redirect(route('login'))->withInfo('You have successfully logged out!');
})->name('logout');

Auth::routes(['verify' => true]);

Route::name('js.')->group(function() {
    Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
});

// Get authenticated user
Route::get('users/auth', function() {
    return response()->json(['user' => Auth::check() ? Auth::user() : false]);
});


  Route::get('add-task', [ 'as' => 'add-task', 'uses' => 'TaskController@addTask']);
    Route::post('post-task', [ 'as' => 'post-task', 'uses' => 'TaskController@postTask']);
    Route::get('edit-task/{id}', [ 'as' => 'edit-task', 'uses' => 'TaskController@editTask']);
    Route::post('update-task/{id}', [ 'as' => 'update-task', 'uses' => 'TaskController@updateTask']);
    Route::get('task-list', [ 'as' => 'task-list', 'uses' => 'TaskController@index']);
    Route::get('delete-task/{id}',['as'=>'delete-task','uses'=>'TaskController@deleteTask']);