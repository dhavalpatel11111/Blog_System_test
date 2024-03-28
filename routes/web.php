<?php

use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});


Route::any("/alluser_list", [postController::class, 'alluser_list'])->middleware("auth");
Route::any("/addto_you_foloow", [postController::class, 'addto_you_foloow'])->middleware("auth");
Route::any("/following", [postController::class, 'following'])->middleware("auth");
Route::any("/Followers", [postController::class, 'Followers'])->middleware("auth");
Route::any("/people_post", [postController::class, 'people_post'])->middleware("auth");
Route::any("/like", [postController::class, 'like'])->middleware("auth");
Route::any("/dislike", [postController::class, 'dislike'])->middleware("auth");

Route::any("/create", function () {
    return view("create");
})->middleware("auth");

Route::any("/add", [postController::class, 'add'])->middleware("auth");
Route::any("/list", [postController::class, 'list'])->middleware("auth");
Route::any("/delete", [postController::class, 'delete'])->middleware("auth");
Route::any("/edit", [postController::class, 'edit'])->middleware("auth");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
