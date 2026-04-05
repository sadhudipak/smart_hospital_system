<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor.user'])
            ->latest()
            ->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'doctor.user', 'doctor.department', 'prescription']);

        return view('admin.appointments.show', compact('appointment'));
    }

    public function reports()
    {
        $stats = [
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'approved_appointments' => Appointment::where('status', 'approved')->count(),
            'completed_appointments' => Appointment::where('status', 'completed')->count(),
            'rejected_appointments' => Appointment::where('status', 'rejected')->count(),
            'today_appointments' => Appointment::whereDate('appointment_date', today())->count(),
        ];

        $monthly_stats = Appointment::selectRaw('MONTH(appointment_date) as month, COUNT(*) as count')
            ->whereYear('appointment_date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.reports', compact('stats', 'monthly_stats'));
    }
}