<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $doctor = auth()->user()->doctor;
        
        $query = $doctor->appointments()->with('patient');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        $appointments = $query->latest('appointment_date')->paginate(10);

        return view('doctor.appointments.index', compact('appointments'));
    }

    public function approve(Appointment $appointment)
    {
        $this->authorizeAppointment($appointment);
        
        $appointment->update(['status' => 'approved']);

        return back()->with('success', 'Appointment approved successfully!');
    }

    public function reject(Request $request, Appointment $appointment)
    {
        $this->authorizeAppointment($appointment);
        
        $appointment->update([
            'status' => 'rejected',
            'doctor_note' => $request->reason,
        ]);

        return back()->with('success', 'Appointment rejected.');
    }

    public function complete(Appointment $appointment)
    {
        $this->authorizeAppointment($appointment);
        
        $appointment->update(['status' => 'completed']);

        return back()->with('success', 'Appointment marked as completed!');
    }

    private function authorizeAppointment(Appointment $appointment)
    {
        if ($appointment->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }
    }
}
