<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAvatarRequest;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
        // $request->validate();
        // dd($request->input('avatar'));
        // $path = $request->file('avatar')->store('avatars', 'public');
        // dd($path);
        if($oldAvatar = $request->user()->avatar){
            // dd($oldAvatar);
            Storage::disk('public')->delete($oldAvatar);
        }
        
        auth()->user()->update(['avatar' => $path]);
        //dd(auth()->user());
        // store avatar
        // return response()->redirectTo(route('profile.edit'));
        // return back()->with(['message' => 'Avatar is changed']);
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
