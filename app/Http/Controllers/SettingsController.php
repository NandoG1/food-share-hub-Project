<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        $schoolSetting = SchoolSetting::where('user_id', $user->id)->first();

        return view('settings.edit', compact('schoolSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_address' => 'required|string',
            'school_phone' => 'nullable|string|max:15',
            'school_email' => 'nullable|email|max:255',
            'principal_name' => 'nullable|string|max:255',
            'school_level' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'program_coordinator' => 'nullable|string|max:255',
            'coordinator_phone' => 'nullable|string|max:15',
            'coordinator_email' => 'nullable|email|max:255',
        ]);

        $user = Auth::user();

        $schoolSetting = SchoolSetting::updateOrCreate(
            ['user_id' => $user->id],
            $request->except('_token', '_method')
        );

        return redirect()->route('settings.edit')
            ->with('success', 'School information has been updated successfully.');
    }

    
}