<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    public function editAdmin()
    {
        $admin = Auth::guard('admin')->user();
        $profileCompletion = $this->getProfileCompletion();

        return view('admin-settings.settings', compact('admin', 'profileCompletion'));
    }

    public function editAdminDetail()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin-settings.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'nullable|string|min:6|max:255',
            'admin_phone' => 'nullable|string|max:15',
        ]);

        $admin = Admin::findOrFail($id);

        $admin->name = $request->admin_name;
        $admin->email = $request->admin_email;

        if ($request->filled('admin_password')) {
            $admin->password = bcrypt($request->admin_password);
        }

        $admin->phone = $request->admin_phone;

        $admin->save();

        return redirect()->route('admin.settings')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'admin_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $admin = Admin::findOrFail($id);

        if ($request->hasFile('admin_photo')) {
            if ($admin->photo) {
                Storage::delete('public/' . $admin->photo);
            }
            $photoPath = $request->file('admin_photo')->store('upload-image-admin', 'public');
            $admin->photo = $photoPath;
            $admin->save();
        }

        return redirect()->back()->with('success', 'Foto berhasil diperbarui!');
    }

    public function updateBio(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:500',
        ]);

        $bio = trim($request->bio);
        $bio = preg_replace('/\s+/', ' ', $bio); 
    
        
        $admin = Auth::guard('admin')->user();
        $admin->bio = $request->bio;
        $admin->save();

        return redirect()->back()->with('success', 'Bio berhasil diperbarui!');
    }

    public function getProfileCompletion()
    {
        $admin = Auth::guard('admin')->user();

        $fields = [
            'name',
            'email',
            'password',
            'phone',
            'photo',
            'bio',
        ];

        $filledFields = 0;
        foreach ($fields as $field) {
            if (!empty($admin->$field)) {
                $filledFields++;
            }
        }

        $completionPercentage = round(($filledFields / count($fields)) * 100);

        return $completionPercentage;
    }


}