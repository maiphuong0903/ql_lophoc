<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        try{
            $user = User::find($request->user()->id);
            $userData = $request->all();
            $avatar = $this->uploadImage($request['avatar']); 
            $userData['avatar'] = $avatar;

            $user->update($userData);

            return redirect()->route('class')->with('success', 'Cập nhật thông tin thành công');

        }catch (Exception $e){
            return redirect()->back()->with('error', 'Cập nhật thông tin thất bại');
        }
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function uploadImage($file) {
        if ($file) {   
            $originName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();           
            $currentDateTime = now()->format('dmY_Hi');
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $fileName = $fileName . '_' . $currentDateTime . '.' . $extension;
            $file->storeAs('public/images', $fileName);
            return asset('storage/images/' . $fileName);
        }

        return null;
    }
}
