<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::where('role', 'patient')
            ->with(['appointments', 'prescriptions'])
            ->latest()
            ->paginate(15);

        return view('admin.patients.index', compact('patients'));
    }

    public function show(User $patient)
    {
        $patient->load(['appointments.doctor.user', 'prescriptions.doctor.user']);

        $stats = [
            'total_appointments' => $patient->appointments()->count(),
            'completed_appointments' => $patient->appointments()->where('status', 'completed')->count(),
            'pending_appointments' => $patient->appointments()->where('status', 'pending')->count(),
            'total_prescriptions' => $patient->prescriptions()->count(),
        ];

        return view('admin.patients.show', compact('patient', 'stats'));
    }
}