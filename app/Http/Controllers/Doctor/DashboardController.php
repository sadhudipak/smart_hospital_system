<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = auth()->user()->doctor;
        
        $stats = [
            'total_appointments' => $doctor->appointments()->count(),
            'pending_appointments' => $doctor->appointments()->where('status', 'pending')->count(),
            'today_appointments' => $doctor->appointments()->whereDate('appointment_date', today())->count(),
            'completed_appointments' => $doctor->appointments()->where('status', 'completed')->count(),
        ];

        $today_appointments = $doctor->appointments()
            ->with('patient')
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        $pending_appointments = $doctor->appointments()
            ->with('patient')
            ->where('status', 'pending')
            ->orderBy('appointment_date')
            ->take(5)
            ->get();

        return view('doctor.dashboard', compact('stats', 'today_appointments', 'pending_appointments'));
    }
}
