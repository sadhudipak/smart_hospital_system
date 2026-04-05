<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['patient', 'appointment'])
            ->where('doctor_id', auth()->user()->doctor->id)
            ->latest()
            ->paginate(10);

        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    public function create(Appointment $appointment)
    {
        if ($appointment->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }

        return view('doctor.prescriptions.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'diagnosis' => 'required|string',
            'medicines' => 'required|array|min:1',
            'medicines.*.name' => 'required|string',
            'medicines.*.dosage' => 'required|string',
            'medicines.*.duration' => 'required|string',
            'medicines.*.instructions' => 'nullable|string',
            'advice' => 'nullable|string',
            'next_visit' => 'nullable|date|after:today',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        
        if ($appointment->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }

        Prescription::create([
            'appointment_id' => $appointment->id,
            'doctor_id' => auth()->user()->doctor->id,
            'patient_id' => $appointment->patient_id,
            'diagnosis' => $request->diagnosis,
            'medicines' => $request->medicines,
            'advice' => $request->advice,
            'next_visit' => $request->next_visit,
        ]);

        $appointment->update(['status' => 'completed']);

        return redirect()->route('doctor.prescriptions.index')
            ->with('success', 'Prescription sent to patient successfully!');
    }

    public function show(Prescription $prescription)
    {
        if ($prescription->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }

        return view('doctor.prescriptions.show', compact('prescription'));
    }
}

