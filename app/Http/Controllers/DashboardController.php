<?php

namespace App\Http\Controllers;

use App\Models\FoodRequest;

class DashboardController extends Controller
{

    public function index()
    {
       
        $totalRequests = FoodRequest::count();

      
        $approvedRequests = FoodRequest::where('status', 'approved')->count();

       
        $connectedSchools = FoodRequest::distinct('school_name')->count('school_name');

      
        $lastMonth = now()->subMonth();
        $totalRequestsLastMonth = FoodRequest::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $approvedRequestsLastMonth = FoodRequest::where('status', 'approved')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

       
        $totalRequestsDifference = $totalRequests - $totalRequestsLastMonth;
        $approvedRequestsDifference = $approvedRequests - $approvedRequestsLastMonth;

        return view('dashboard', compact(
            'totalRequests',
            'approvedRequests',
            'connectedSchools',
            'totalRequestsDifference',
            'approvedRequestsDifference'
        ));
    }
}
