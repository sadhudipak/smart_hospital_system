{{-- resources/views/doctor/prescriptions/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Create Prescription')
@section('page-title', 'Create Prescription')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Create Prescription</h2>
            <p class="text-gray-600">Create a prescription for your patient</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <h3 class="text-red-800 font-medium mb-2">Please fix the following errors:</h3>
                <ul class="text-red-700 text-sm">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Patient & Appointment Info -->
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Appointment Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Patient Information</h4>
                    <div class="bg-white rounded-lg p-4">
                        <p class="font-medium text-gray-800">{{ $appointment->patient->name }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->patient->email }}</p>
                        @if($appointment->patient->phone)
                            <p class="text-sm text-gray-600">{{ $appointment->patient->phone }}</p>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Appointment Information</h4>
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-sm text-gray-600">Date: {{ $appointment->appointment_date->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-600">Time: {{ date('g:i A', strtotime($appointment->appointment_time)) }}</p>
                        <p class="text-sm text-gray-600">Symptoms: {{ $appointment->symptoms ?: 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('doctor.prescriptions.store') }}" x-data="prescriptionForm()">
            @csrf
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <!-- Diagnosis -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Diagnosis</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Patient Diagnosis <span class="text-red-500">*</span></label>
                    <textarea name="diagnosis" rows="3" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                              placeholder="Enter your diagnosis...">{{ old('diagnosis') }}</textarea>
                    @error('diagnosis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Medicines -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Medicines</h3>
                    <button type="button" @click="addMedicine"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700">
                        <i class="fas fa-plus mr-2"></i>Add Medicine
                    </button>
                </div>

                <div id="medicines-container" class="space-y-4">
                    <template x-for="(medicine, index) in medicines" :key="index">
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="font-medium text-gray-800">Medicine #<span x-text="index + 1"></span></h4>
                                <button type="button" @click="removeMedicine(index)"
                                        class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Medicine Name <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'medicines[' + index + '][name]'" x-model="medicine.name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dosage <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'medicines[' + index + '][dosage]'" x-model="medicine.dosage" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="e.g., 1 tablet, 5ml">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Duration <span class="text-red-500">*</span></label>
                                    <input type="text" :name="'medicines[' + index + '][duration]'" x-model="medicine.duration" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="e.g., 7 days, 2 weeks">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instructions</label>
                                    <input type="text" :name="'medicines[' + index + '][instructions]'" x-model="medicine.instructions"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="e.g., After meals, Before sleep">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                @error('medicines')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Additional Information -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Additional Information</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Doctor's Advice</label>
                        <textarea name="advice" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                  placeholder="Any additional advice for the patient...">{{ old('advice') }}</textarea>
                        @error('advice')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Next Visit Date</label>
                        <input type="date" name="next_visit" value="{{ old('next_visit') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('next_visit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('doctor.appointments.index') }}"
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 gradient-bg text-white rounded-lg font-medium hover:shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>Send Prescription
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function prescriptionForm() {
    return {
        medicines: [
            { name: '', dosage: '', duration: '', instructions: '' }
        ],

        addMedicine() {
            this.medicines.push({ name: '', dosage: '', duration: '', instructions: '' });
        },

        removeMedicine(index) {
            if (this.medicines.length > 1) {
                this.medicines.splice(index, 1);
            }
        }
    }
}
</script>
@endsection