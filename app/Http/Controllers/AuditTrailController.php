<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditTrailController extends Controller
{
    public function index()
    {
        $logs = Activity::with('causer')->latest()->paginate(10);
        return view('audit.index', compact('logs'));
    }
}
