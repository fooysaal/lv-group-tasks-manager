<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupTaskController;
use App\Http\Controllers\GroupMemberController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::put('/{group_member_id}', [GroupMemberController::class, 'updateGroupStatus'])->name('update-group-status');
    Route::delete('/{group_member_id}', [GroupMemberController::class, 'destroy'])->name('groups.members.remove');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //groups routes
    Route::resource('groups', GroupController::class);
    //group members routes
    Route::post('/groups/{group}/members', [GroupController::class, 'addMember'])->name('groups.members.add');
    //group tasks routes
    Route::get('{group}/tasks/create', [GroupTaskController::class, 'create'])->name('group.tasks.create');

});
require __DIR__.'/auth.php';
