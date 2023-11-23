<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Policies\ProfilePolicy;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('profile.showProfile',compact('user'));
        //this code is istead of this
        // return view('profile',[
        //     'user'=>$user
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        $editingProf = true;
        return view('profile.showProfile',compact('user','editingProf'));
    }

    /**
     * Update the specified resource in storage.
     */
    //when having an instance of a form request it injects the functions automatically
    // it validates the input and authorize the users
    public function update(UpdateUserRequest $request,User $user)
    {

        $this->authorize('update',$user);

        $validated = $request->validated();

        if($request->has('image')){
            $imagePath = $request->file('image')->store('app','public');
            $validated['image'] = $imagePath;

            if($user->image != null)
                Storage::disk('public')->delete($user->image);
        }
        $user->update($validated);
        return redirect()->route('users.show',$user->id)->with('success','profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $password = request()->get('password');
        if(Hash::check($password,$user->password)){
            Storage::disk('public')->delete($user->image);
            User::destroy($user->id);
            Auth::logout();
            return redirect()->route('register');
        }
        return back()->withErrors([
            'password' => 'the password is incorrect!'
        ]);
    }

    public function follow(User $user){
        $follower = Auth::user();
        $follower->followings()->attach($user);
        return back()->with('success','wow you have followed '.$user->name.'!');
    }
    public function unfollow(User $user){
        $follower = Auth::user();
        $follower->followings()->detach($user);
        return back()->with('success','you have unfollowed '.$user->name.'!');
    }

    public function like(Idea $idea){
        $user = auth()->user();
        $user->Userlikes()->attach($idea);
        return back();
    }

    public function unlike(Idea $idea){
        $user = Auth::user();
        $user->Userlikes()->detach($idea);
        return back();
    }


}
