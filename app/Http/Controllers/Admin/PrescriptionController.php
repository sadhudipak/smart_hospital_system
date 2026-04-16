<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['patient.user', 'doctor.user', 'appointment'])
            ->latest()
            ->paginate(15);

        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['patient', 'doctor.user', 'appointment']);

        return view('admin.prescriptions.show', compact('prescription'));
    }
}