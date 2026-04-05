<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Prescription;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->appointments()->with('doctor.user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->latest('appointment_date')->paginate(10);

        return view('patient.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        $doctors = Doctor::with(['user', 'department'])
            ->whereHas('user', fn($q) => $q->where('is_active', true))
            ->get();

        return view('patient.appointments.create', compact('departments', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'symptoms' => 'required|string|max:1000',
            'patient_note' => 'nullable|string|max:500',
        ]);

        // Check if slot is available
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereNotIn('status', ['cancelled', 'rejected'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked.'])
                ->withInput();
        }

        Appointment::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'symptoms' => $request->symptoms,
            'patient_note' => $request->patient_note,
        ]);

        return redirect()->route('patient.appointments.index')
            ->with('success', 'Appointment booked successfully! Waiting for doctor approval.');
    }

    public function show(Appointment $appointment)
    {
        if ($appointment->patient_id !== auth()->id()) {
            abort(403);
        }

        $appointment->load(['doctor.user', 'prescription']);

        return view('patient.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->patient_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($appointment->status, ['pending'])) {
            return back()->withErrors(['error' => 'Cannot cancel this appointment.']);
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled.');
    }

    public function prescriptions()
    {
        $prescriptions = auth()->user()->prescriptions()
            ->with(['doctor.user', 'appointment'])
            ->latest()
            ->paginate(10);

        return view('patient.prescriptions.index', compact('prescriptions'));
    }

    public function showPrescription(Prescription $prescription)
    {
        if ($prescription->patient_id !== auth()->id()) {
            abort(403);
        }

        $prescription->load(['doctor.user', 'appointment']);

        return view('patient.prescriptions.show', compact('prescription'));
    }
}

