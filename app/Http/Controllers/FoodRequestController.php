<?php

namespace App\Http\Controllers;

use App\Models\FoodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodRequestController extends Controller
{
    public function create()
    {
        return view('food-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'student_count' => 'required|integer|min:1',
            'requested_date' => 'required|date|after_or_equal:today',
            'additional_notes' => 'nullable|string',
        ]);

        $foodRequest = new FoodRequest($validated);
        $foodRequest->user_id = Auth::id();
        $foodRequest->status = 'pending';
        $foodRequest->save();

        return redirect()->route('food-requests.index')
            ->with('success', 'Permintaan makanan berhasil diajukan. Tim kami akan segera meninjau permintaan Anda.');
    }

    public function index()
    {
        $foodRequests = FoodRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('food-requests.index', compact('foodRequests'));
    }

    public function show(FoodRequest $foodRequest)
    {
        if (Auth::id() !== $foodRequest->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('food-requests.show', compact('foodRequest'));
    }

    public function seerequests()
    {
        $foodRequests = FoodRequest::orderBy('created_at', 'desc')->paginate(10);

        return view('admin-requests.see-requests', compact('foodRequests'));
    }


    public function approve($id)
    {
        $foodRequest = FoodRequest::findOrFail($id);
        $admin = Auth::user(); // Admin yang sedang login
    
        $foodRequest->status = 'approved';
        $foodRequest->admin_id = $admin->id; // Simpan admin yang menyetujui
        $foodRequest->save();
    
        // Tambahkan jumlah approve pada admin
        $admin->increment('approved');
    
        return redirect()->back()->with('success', 'Permintaan makanan disetujui.');
    }
    
    public function reject($id, Request $request)
    {
        $foodRequest = FoodRequest::findOrFail($id);
        $admin = Auth::user(); // Admin yang sedang login
    
        $foodRequest->status = 'rejected';
        $foodRequest->admin_id = $admin->id; // Simpan admin yang menolak
        // $foodRequest->rejection_reason = 
        $foodRequest->rejection_reason = $request->input('rejection_reason');
        $foodRequest->save();
    
        // Tambahkan jumlah reject pada admin
        $admin->increment('rejected');
    
        return redirect()->back()->with('success', 'Permintaan makanan ditolak.');
    }
    




}