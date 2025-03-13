<?php

namespace App\Http\Controllers;

use App\Models\FoodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AidHistoryController extends Controller
{
   
    public function index(Request $request)
    {
    
        $status = $request->query('status');
        $dateRange = $request->query('date_range');
        $schoolName = $request->query('school_name');

       
        $query = FoodRequest::with('user')
            ->select('food_requests.*')
            ->addSelect(DB::raw('(SELECT COUNT(*) FROM food_requests as fr WHERE fr.school_name = food_requests.school_name) as school_request_count'));

       
        if ($status) {
            $query->where('status', $status);
        }

        if ($dateRange) {
           
            if ($dateRange === 'last-week') {
                $query->where('created_at', '>=', now()->subWeek());
            } elseif ($dateRange === 'last-month') {
                $query->where('created_at', '>=', now()->subMonth());
            } elseif ($dateRange === 'last-3-months') {
                $query->where('created_at', '>=', now()->subMonths(3));
            }
        }

        if ($schoolName) {
            $query->where('school_name', 'like', "%$schoolName%");
        }

      
        $stats = [
            'total' => FoodRequest::count(),
            'pending' => FoodRequest::where('status', 'pending')->count(),
            'approved' => FoodRequest::where('status', 'approved')->count(),
            'rejected' => FoodRequest::where('status', 'rejected')->count(),
            'unique_schools' => FoodRequest::distinct('school_name')->count('school_name'),
            'total_students' => FoodRequest::where('status', 'approved')->sum('student_count'),
        ];

       
        $monthlyData = FoodRequest::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as approved'),
            DB::raw('SUM(CASE WHEN status = "rejected" THEN 1 ELSE 0 END) as rejected'),
            DB::raw('SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending')
        )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $monthName = date('M', mktime(0, 0, 0, $item->month, 1));

                return [
                    'month_name' => $monthName.' '.$item->year,
                    'total' => $item->total,
                    'approved' => $item->approved,
                    'rejected' => $item->rejected,
                    'pending' => $item->pending,
                ];
            });

     
        $topSchools = FoodRequest::select('school_name', DB::raw('COUNT(*) as request_count'))
            ->groupBy('school_name')
            ->orderBy('request_count', 'desc')
            ->limit(5)
            ->get();

        
        $foodRequests = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('aid-history.index', compact(
            'foodRequests',
            'stats',
            'monthlyData',
            'topSchools',
            'status',
            'dateRange',
            'schoolName'
        ));
    }

   
    public function show(FoodRequest $foodRequest)
    {
       
        $schoolHistory = FoodRequest::where('school_name', $foodRequest->school_name)
            ->where('id', '!=', $foodRequest->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('aid-history.show', compact('foodRequest', 'schoolHistory'));
    }

    public function historyAdmin()
    {
        $foodRequests = FoodRequest::orderBy('created_at', 'desc')->paginate(10);

        return view('admin-history.history', compact('foodRequests'));
    }

    
}
