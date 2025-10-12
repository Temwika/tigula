@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-orange-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/30 p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Register New Farmer</h1>
                    <p class="text-gray-600">Add a new farmer to the Tigula platform</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-orange-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-white/30 p-8">
            <form method="POST" action="{{ route('farmers.store') }}" class="space-y-8">
                @csrf

                <!-- Personal Information Section -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Personal Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" 
                                   id="full_name" 
                                   name="full_name" 
                                   value="{{ old('full_name') }}"
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('full_name') border-red-500 @enderror"
                                   placeholder="Enter farmer's full name">
                            @error('full_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NRC Number -->
                        <div>
                            <label for="nrc_number" class="block text-sm font-medium text-gray-700 mb-2">NRC Number</label>
                            <input type="text" 
                                   id="nrc_number" 
                                   name="nrc_number" 
                                   value="{{ old('nrc_number') }}"
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('nrc_number') border-red-500 @enderror"
                                   placeholder="e.g., 123456/12/1">
                            @error('nrc_number')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" 
                                   id="phone_number" 
                                   name="phone_number" 
                                   value="{{ old('phone_number') }}"
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('phone_number') border-red-500 @enderror"
                                   placeholder="e.g., +260971234567">
                            @error('phone_number')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Location Information Section -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Location Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Village -->
                        <div>
                            <label for="village" class="block text-sm font-medium text-gray-700 mb-2">Village</label>
                            <input type="text" 
                                   id="village" 
                                   name="village" 
                                   value="{{ old('village') }}"
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('village') border-red-500 @enderror"
                                   placeholder="Enter village name">
                            @error('village')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- District -->
                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-2">District</label>
                            <select id="district" 
                                    name="district" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('district') border-red-500 @enderror">
                                <option value="">Select District</option>
                                <option value="Sinda" {{ old('district') == 'Sinda' ? 'selected' : '' }}>Sinda</option>
                                <option value="Katete" {{ old('district') == 'Katete' ? 'selected' : '' }}>Katete</option>
                                <option value="Lundazi" {{ old('district') == 'Lundazi' ? 'selected' : '' }}>Lundazi</option>
                                <option value="Mambwe" {{ old('district') == 'Mambwe' ? 'selected' : '' }}>Mambwe</option>
                                <option value="Nyimba" {{ old('district') == 'Nyimba' ? 'selected' : '' }}>Nyimba</option>
                                <option value="Petauke" {{ old('district') == 'Petauke' ? 'selected' : '' }}>Petauke</option>
                                <option value="Chipata" {{ old('district') == 'Chipata' ? 'selected' : '' }}>Chipata</option>
                                <option value="Chadiza" {{ old('district') == 'Chadiza' ? 'selected' : '' }}>Chadiza</option>
                                <option value="Vubwi" {{ old('district') == 'Vubwi' ? 'selected' : '' }}>Vubwi</option>
                            </select>
                            @error('district')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Province -->
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                            <select id="province" 
                                    name="province" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('province') border-red-500 @enderror">
                                <option value="">Select Province</option>
                                <option value="Eastern" {{ old('province') == 'Eastern' ? 'selected' : '' }}>Eastern</option>
                                <option value="Central" {{ old('province') == 'Central' ? 'selected' : '' }}>Central</option>
                                <option value="Copperbelt" {{ old('province') == 'Copperbelt' ? 'selected' : '' }}>Copperbelt</option>
                                <option value="Luapula" {{ old('province') == 'Luapula' ? 'selected' : '' }}>Luapula</option>
                                <option value="Lusaka" {{ old('province') == 'Lusaka' ? 'selected' : '' }}>Lusaka</option>
                                <option value="Muchinga" {{ old('province') == 'Muchinga' ? 'selected' : '' }}>Muchinga</option>
                                <option value="Northern" {{ old('province') == 'Northern' ? 'selected' : '' }}>Northern</option>
                                <option value="North-Western" {{ old('province') == 'North-Western' ? 'selected' : '' }}>North-Western</option>
                                <option value="Southern" {{ old('province') == 'Southern' ? 'selected' : '' }}>Southern</option>
                                <option value="Western" {{ old('province') == 'Western' ? 'selected' : '' }}>Western</option>
                            </select>
                            @error('province')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Grain Transaction Section (Optional) -->
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Grain Delivery (Optional)
                    </h3>
                    
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-yellow-800 font-medium">Record Grain Delivery</p>
                                <p class="text-yellow-700 text-sm mt-1">If the farmer is bringing grain now, fill in the details below. SMS notifications will be sent automatically.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Grain Type -->
                        <div>
                            <label for="grain_type_id" class="block text-sm font-medium text-gray-700 mb-2">Grain Type</label>
                            <select id="grain_type_id" 
                                    name="grain_type_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('grain_type_id') border-red-500 @enderror">
                                <option value="">Select Grain Type</option>
                                @foreach($grainTypes as $grainType)
                                    <option value="{{ $grainType->id }}" 
                                            data-price="{{ $grainType->current_price }}"
                                            {{ old('grain_type_id') == $grainType->id ? 'selected' : '' }}>
                                        {{ $grainType->name }} (K{{ number_format($grainType->current_price, 2) }}/{{ $grainType->unit }})
                                    </option>
                                @endforeach
                            </select>
                            @error('grain_type_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Weight -->
                        <div>
                            <label for="weight_kg" class="block text-sm font-medium text-gray-700 mb-2">Weight (KG)</label>
                            <input type="number" 
                                   id="weight_kg" 
                                   name="weight_kg" 
                                   value="{{ old('weight_kg') }}"
                                   step="0.1" 
                                   min="0.1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('weight_kg') border-red-500 @enderror"
                                   placeholder="e.g., 50.5">
                            @error('weight_kg')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Depot -->
                        <div>
                            <label for="depot_id" class="block text-sm font-medium text-gray-700 mb-2">Delivery Point</label>
                            <select id="depot_id" 
                                    name="depot_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200 bg-white/70 backdrop-blur-sm @error('depot_id') border-red-500 @enderror">
                                <option value="">Select Depot</option>
                                @foreach($depots as $depot)
                                    <option value="{{ $depot->id }}" {{ old('depot_id') == $depot->id ? 'selected' : '' }}>
                                        {{ $depot->name }} - {{ $depot->location }}
                                    </option>
                                @endforeach
                            </select>
                            @error('depot_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estimated Total -->
                        <div>
                            <label for="estimated_total" class="block text-sm font-medium text-gray-700 mb-2">Estimated Total</label>
                            <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-600 font-medium text-lg">
                                K<span id="total_amount">0.00</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Auto-calculated based on current prices</p>
                        </div>
                    </div>

                    <!-- SMS Notification Preview -->
                    <div class="mt-6">
                        <!-- Always show welcome SMS info -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
                            <h4 class="font-medium text-green-900 mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                📱 Welcome SMS (Always Sent)
                            </h4>
                            <div class="bg-white rounded-lg p-3 border">
                                <p class="text-sm text-gray-600">
                                    <strong>To Farmer:</strong> "Welcome to Tigula, [Name]! You are now part of Zambia's smartest grain trading platform. Sell your grains, track transactions, and get paid instantly via mobile money. For support, contact us. Happy trading!"
                                </p>
                            </div>
                        </div>

                        <!-- Grain transaction SMS preview -->
                        <div id="sms_preview" class="hidden">
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <h4 class="font-medium text-blue-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    📦 Additional Grain Delivery SMS:
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white rounded-lg p-3 border">
                                        <p class="text-sm font-medium text-gray-700 mb-1">To Farmer (Registration + Grain):</p>
                                        <p class="text-sm text-gray-600" id="farmer_sms_preview">SMS preview will appear here...</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 border">
                                        <p class="text-sm font-medium text-gray-700 mb-1">To Admin (New Farmer Alert):</p>
                                        <p class="text-sm text-gray-600" id="admin_sms_preview">SMS preview will appear here...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('farmers.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Farmers
                    </a>
                    
                    <button type="submit" 
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-orange-600 text-white font-medium rounded-xl hover:from-green-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-lg hover:shadow-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Register Farmer
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white/60 backdrop-blur-md rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Instant Registration</h4>
                <p class="text-gray-600 text-sm">Quick and easy farmer registration process</p>
            </div>

            <div class="bg-white/60 backdrop-blur-md rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">SMS Notifications</h4>
                <p class="text-gray-600 text-sm">Farmers receive instant SMS updates</p>
            </div>

            <div class="bg-white/60 backdrop-blur-md rounded-xl p-6 text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Secure Payments</h4>
                <p class="text-gray-600 text-sm">Safe and instant mobile money payments</p>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-select Eastern Province for districts in Eastern Province
document.getElementById('district').addEventListener('change', function() {
    const easternDistricts = ['Sinda', 'Katete', 'Lundazi', 'Mambwe', 'Nyimba', 'Petauke', 'Chipata', 'Chadiza', 'Vubwi'];
    const provinceSelect = document.getElementById('province');
    
    if (easternDistricts.includes(this.value)) {
        provinceSelect.value = 'Eastern';
    }
});

// Phone number formatting
document.getElementById('phone_number').addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    if (value.startsWith('260')) {
        value = '+' + value;
    } else if (value.startsWith('0')) {
        value = '+260' + value.substring(1);
    } else if (!value.startsWith('+')) {
        value = '+260' + value;
    }
    this.value = value;
});

// Grain transaction calculations and SMS preview
function updateTransactionCalculations() {
    const grainTypeSelect = document.getElementById('grain_type_id');
    const weightInput = document.getElementById('weight_kg');
    const totalElement = document.getElementById('total_amount');
    const smsPreview = document.getElementById('sms_preview');
    const farmerNameInput = document.getElementById('full_name');
    
    if (grainTypeSelect.value && weightInput.value && weightInput.value > 0) {
        const selectedOption = grainTypeSelect.options[grainTypeSelect.selectedIndex];
        const price = parseFloat(selectedOption.dataset.price) || 0;
        const weight = parseFloat(weightInput.value) || 0;
        const total = price * weight;
        
        totalElement.textContent = total.toFixed(2);
        
        // Show SMS preview
        if (farmerNameInput.value) {
            const farmerName = farmerNameInput.value;
            const grainName = selectedOption.text.split(' (')[0];
            const transactionNumber = 'TXN-' + Math.random().toString(36).substr(2, 9).toUpperCase();
            
                            const farmerSMS = `Welcome to Tigula, ${farmerName}! Your registration is complete and we've recorded your ${grainName} delivery of ${weight}kg. Transaction: #${transactionNumber}. Amount: K${total.toFixed(2)}. Payment will be processed after approval. Thank you for choosing Tigula!`;
                            const adminSMS = `[TIGULA] New Farmer Registration: ${farmerName} has joined with ${grainName} delivery. Grain: ${grainName} (${weight}kg), Amount: K${total.toFixed(2)}, Transaction: #${transactionNumber}. Please review and approve payment.`;            document.getElementById('farmer_sms_preview').textContent = farmerSMS;
            document.getElementById('admin_sms_preview').textContent = adminSMS;
            smsPreview.classList.remove('hidden');
        }
    } else {
        totalElement.textContent = '0.00';
        smsPreview.classList.add('hidden');
    }
}

// Event listeners for transaction calculations
document.getElementById('grain_type_id').addEventListener('change', updateTransactionCalculations);
document.getElementById('weight_kg').addEventListener('input', updateTransactionCalculations);
document.getElementById('full_name').addEventListener('input', updateTransactionCalculations);

// Clear grain transaction when form is reset
document.querySelector('form').addEventListener('reset', function() {
    document.getElementById('total_amount').textContent = '0.00';
    document.getElementById('sms_preview').classList.add('hidden');
});
</script>
@endsection