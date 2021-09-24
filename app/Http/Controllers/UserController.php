<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserAddRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show(User $user)
    {
        if (!$this->checkRight($user->id)) {
            return redirect('error')->with('alert-danger', 'Accès interdit !');
        }
        return view('Users.showUser', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.editUser', compact('user'));
    }

    public function update(UserAddRequest $request, User $user)
    {
        if (!$this->checkRight($user->id)) {
            return redirect('error')->with('alert-danger', 'Accès interdit !');
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return view('users.showUser', compact('user'));
    }

    public function deleteProfil()
    {
        $user = Auth::user();
        return view('users.delete-profil', compact('user'));
    }

    public function destroy(User $user)
    {
        if (!$this->checkRight($user->id)) {
            return redirect('error')->with('alert-danger', 'Accès interdit !');
        }
        $user->delete();
        Auth::logout();
        return redirect('login');
    }
}
