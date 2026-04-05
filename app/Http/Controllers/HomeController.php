<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $departments = Department::where('is_active', true)->take(6)->get();
        $doctors = Doctor::with(['user', 'department'])
            ->whereHas('user', fn($q) => $q->where('is_active', true))
            ->take(4)->get();
            
        return view('pages.home', compact('departments', 'doctors'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Send email logic here
        
        return back()->with('success', 'Message sent successfully!');
    }

    public function doctors()
    {
        $doctors = Doctor::with(['user', 'department'])
            ->whereHas('user', fn($q) => $q->where('is_active', true))
            ->paginate(12);
        $departments = Department::where('is_active', true)->get();
        
        return view('pages.doctors', compact('doctors', 'departments'));
    }
}
