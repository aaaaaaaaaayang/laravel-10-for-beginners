<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
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
    //return view('welcome');
    //$users = DB::select("select * from users");

    $users = User::find(11);
    // create new user
    // $user = DB::insert('insert into users (name, email, password) values (?,?,?)',[
    //     'Sarthak',
    //     'sarthakabitfumes.com',
    //     'password',
    // ]);

    // $user = User::create([
    //     'name'      => 'Sarthak',
    //     'email'     => 'sarthak4@bitfumes.com',
    //     'password'  => 'password',
    // ]);
    // $user = DB::update("update users set email='abc@bitfumes.com' where id=4");
    // $users = DB::delete("delete from users where id=4");

    // $titles = DB::table('users')->pluck('name', 'email');
 
    // foreach ($titles as $name => $title) {
    //     echo $title;
    // }

    // $users = User::where('id', 1)->first();
    dd($users->name);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
