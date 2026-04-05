<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_appointments' => $user->appointments()->count(),
            'pending_appointments' => $user->appointments()->where('status', 'pending')->count(),
            'upcoming_appointments' => $user->appointments()
                ->whereIn('status', ['pending', 'approved'])
                ->where('appointment_date', '>=', today())
                ->count(),
            'total_prescriptions' => $user->prescriptions()->count(),
        ];

        $upcoming_appointments = $user->appointments()
            ->with('doctor.user')
            ->whereIn('status', ['pending', 'approved'])
            ->where('appointment_date', '>=', today())
            ->orderBy('appointment_date')
            ->take(5)
            ->get();

        $recent_prescriptions = $user->prescriptions()
            ->with('doctor.user')
            ->latest()
            ->take(3)
            ->get();

        return view('patient.dashboard', compact('stats', 'upcoming_appointments', 'recent_prescriptions'));
    }
}
