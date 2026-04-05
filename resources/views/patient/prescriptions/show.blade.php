{{-- resources/views/patient/prescriptions/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Prescription Details')
@section('page-title', 'Prescription')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="gradient-bg p-8 text-white">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-file-medical text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">Medical Prescription</h2>
                        <p class="text-indigo-100 text-sm mt-1">{{ $prescription->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
                <button onclick="window.print()" class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-medium hover:bg-indigo-50 smooth-transition flex items-center space-x-2">
                    <i class="fas fa-print mr-2"></i>
                    <span>Print</span>
                </button>
            </div>
        </div>
        
        <div class="p-8">
            <!-- Doctor & Patient Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-lg p-6 border border-indigo-100">
                    <h3 class="text-sm font-semibold text-gray-600 uppercase mb-3">Doctor Information</h3>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-lg">Dr. {{ $prescription->doctor->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $prescription->doctor->specialization }}</p>
                            <p class="text-xs text-gray-500">{{ $prescription->doctor->qualification }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6 border border-green-100">
                    <h3 class="text-sm font-semibold text-gray-600 uppercase mb-3">Patient Information</h3>
                    <div>
                        <p class="font-semibold text-gray-800 text-lg">{{ $prescription->patient->name }}</p>
                        <p class="text-sm text-gray-600">{{ $prescription->patient->gender }}, {{ $prescription->patient->date_of_birth?->age ?? 'N/A' }} years old</p>
                        <p class="text-sm text-gray-600">{{ $prescription->patient->email }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Diagnosis Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-stethoscope text-indigo-600 mr-3"></i>
                    <span>Diagnosis</span>
                </h3>
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded p-6">
                    <p class="text-gray-700 text-base">{{ $prescription->diagnosis }}</p>
                </div>
            </div>
            
            <!-- Medicines Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-pills text-indigo-600 mr-3"></i>
                    <span>Prescribed Medicines</span>
                </h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b-2 border-gray-200">
                                <th class="text-left px-6 py-4 font-semibold text-gray-700 text-sm">#</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-700 text-sm">Medicine Name</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-700 text-sm">Dosage</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-700 text-sm">Duration</th>
                                <th class="text-left px-6 py-4 font-semibold text-gray-700 text-sm">Instructions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($prescription->medicines as $index => $medicine)
                                <tr class="hover:bg-gray-50 smooth-transition">
                                    <td class="px-6 py-4 text-gray-600 font-medium">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $medicine['name'] }}</td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">{{ $medicine['dosage'] }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $medicine['duration'] }}</td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">{{ $medicine['instructions'] ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        <i class="fas fa-pills text-4xl opacity-20 mb-2"></i>
                                        <p>No medicines prescribed</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Advice Section -->
            @if($prescription->advice)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-comment-medical text-indigo-600 mr-3"></i>
                        <span>Doctor's Advice</span>
                    </h3>
                    <div class="bg-green-50 border-l-4 border-green-500 rounded p-6">
                        <p class="text-gray-700 text-base leading-relaxed">{{ $prescription->advice }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Next Visit -->
            @if($prescription->next_visit)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar-alt text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-lg">Next Visit Recommended</p>
                            <p class="text-gray-600 mt-1">{{ $prescription->next_visit->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Action Buttons -->
            <div class="flex gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('patient.prescriptions.index') }}" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 smooth-transition flex items-center justify-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Prescriptions</span>
                </a>
                <button onclick="window.print()" class="flex-1 px-6 py-3 gradient-bg text-white rounded-lg font-semibold hover:shadow-lg smooth-transition flex items-center justify-center space-x-2">
                    <i class="fas fa-download"></i>
                    <span>Download/Print</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
