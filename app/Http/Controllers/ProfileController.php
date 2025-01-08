<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$request->user()->id],
            'nik' => ['required', 'numeric', 'digits:16', 'unique:'.User::class.',nik,'.$request->user()->id],
            'phone' => ['required', 'numeric', 'digits_between:10,15', 'unique:'.User::class.',phone,'.$request->user()->id],
        ]);
        $user = Auth::user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->nik = $request->input('nik');
        $request->user()->phone = $request->input('phone');
        $request->user()->save();
        
        if($user->role == 'admin'){
            return Redirect::route('admin.settingAdmin')->with('success', 'Profil berhasil diupdate');
        }
        return Redirect::route('user.settingUser')->with('success', 'Profil berhasil diupdate');
    }

    public function updateDataUser(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$user->id],
            'nik' => ['required', 'numeric', 'digits:16', 'unique:'.User::class.',nik,'.$user->id],
            'phone' => ['required', 'numeric', 'digits_between:10,15', 'unique:'.User::class.',phone,'.$user->id],
        ]);
        // $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nik = $request->input('nik');
        $user->phone = $request->input('phone');
        $user->save();
        
        if($user->role == 'admin'){
            return Redirect::route('admin.manageAdmin')->with('success', 'Profil berhasil diupdate');
        }
        return Redirect::route('admin.manageUser')->with('success', 'Profil berhasil diupdate');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
