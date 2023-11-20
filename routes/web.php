<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OpenAI\Laravel\Facades\OpenAI;
use Laravel\Socialite\Facades\Socialite;

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
    // $users = DB::select("select * from users");

    // $users = User::find(11);
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
    // dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/openai',function(){
//     $result = OpenAI::chat()->create([
//         'model' => 'gpt-3.5-turbo',
//         'messages' => [
//             ['role' => 'user', 'content' => 'Hello!'],
//         ],
//     ]);

//     echo $result->choices[0]->message->content; // Hello! How can I assist you today?
// });

Route::post('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    
    $user = User::updateOrCreate(['email' => $user->email], [
        'name' => $user->name,
        'password' => 'password',
    ]);
    
    Auth::login($user);
    
    return redirect('/dashboard');

    // $user->token
});