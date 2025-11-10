<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    //
    public function index(Request $request) {
        $query = ActivityLog::query();

        if ($search = $request->input('search')) {
            $query->where('user_name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%");
        }

        $logs = $query->latest()->paginate(10);
        return view('admin_pages.activity_logs_pages.index', compact('logs'));
    }
}
