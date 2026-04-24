<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\NewAvatarRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\ImageUploadTrait;


class ProfileController extends Controller
{

    use ImageUploadTrait;


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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function changeAvatar(NewAvatarRequest $request)
    {
        // brisanje stare slike
        $avatar = Auth::user()->avatar;

        if ($avatar != null) {
            Storage::disk('public')->delete('images/avatars/' . $avatar);
        }

        // upload nove slike preko traita
        $name = $this->uploadImage(
            $request->file('profile_image'),
            'images/avatars'
        );

        // spremanje u bazu 
        $user = $request->user();
        $user->avatar = $name;
        $user->save();

        return redirect()->back();
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
