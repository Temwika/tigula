@extends('layouts.app')

@section('title', 'New Grain Purchase - Tigula')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-orange-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">⚖️</span>
                        Quick Grain Purchase
                    </h1>
                    <p class="text-gray-600 mt-2">Farmer brought grain to you? Register them, weigh it, and they get paid instantly!</p>
                </div>
                <a href="{{ route('transactions.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-200 flex items-center space-x-2">
                    <span>←</span>
                    <span>Back to Transactions</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <form id="transactionForm" method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Step 1: Find or Register Farmer -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">1</span>
                            Find or Register Farmer
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NRC Number</label>
                                <div class="flex">
                                    <input type="text" id="nrc_search" placeholder="e.g., 123456/78/1" 
                                           class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <button type="button" id="searchFarmer" 
                                            class="px-6 py-2 bg-green-500 text-white rounded-r-lg hover:bg-green-600 transition-colors">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Farmer Details (Hidden initially) -->
                        <div id="farmerDetails" class="hidden border-t pt-4">
                            <div class="bg-green-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-green-800 mb-2">Farmer Found:</h3>
                                <div id="farmerInfo" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                    <!-- Will be populated by JavaScript -->
                                </div>
                                <input type="hidden" id="farmer_id" name="farmer_id">
                            </div>
                        </div>

                        <!-- Register New Farmer Form (Hidden initially) -->
                        <div id="registerFarmer" class="hidden border-t pt-4">
                            <h3 class="font-semibold text-gray-800 mb-4">Register New Farmer:</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="full_name" placeholder="Enter full name" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="text" id="phone_number" placeholder="+260..." 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Village</label>
                                    <input type="text" id="village" placeholder="Enter village" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">District</label>
                                    <input type="text" id="district" placeholder="Enter district" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                    <select id="province" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                        <option value="">Select Province</option>
                                        <option value="Lusaka Province">Lusaka Province</option>
                                        <option value="Central Province">Central Province</option>
                                        <option value="Copperbelt Province">Copperbelt Province</option>
                                        <option value="Eastern Province">Eastern Province</option>
                                        <option value="Western Province">Western Province</option>
                                        <option value="Northern Province">Northern Province</option>
                                        <option value="North-Western Province">North-Western Province</option>
                                        <option value="Southern Province">Southern Province</option>
                                        <option value="Luapula Province">Luapula Province</option>
                                        <option value="Muchinga Province">Muchinga Province</option>
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" id="registerFarmerBtn" 
                                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                        Register Farmer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Transaction Details -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">2</span>
                            Transaction Details
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Grain Type</label>
                                <select name="grain_type_id" id="grain_type_id" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                    <option value="">Select grain type</option>
                                    @foreach($grainTypes as $grainType)
                                        <option value="{{ $grainType->id }}" data-price="{{ $grainType->current_price }}">
                                            {{ $grainType->name }} - {{ $grainType->formatted_price }} {{ $grainType->unit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Depot Location</label>
                                <select name="depot_id" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                    <option value="">Select depot</option>
                                    @foreach($depots as $depot)
                                        <option value="{{ $depot->id }}">{{ $depot->name }} - {{ $depot->full_location }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Weight (kg)</label>
                                <input type="number" name="weight_kg" id="weight_kg" step="0.01" min="1" required 
                                       placeholder="Enter weight in kg" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                                <textarea name="notes" rows="3" placeholder="Additional notes..." 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div class="text-gray-600">
                                <p class="text-sm">Once submitted, SMS notifications will be sent to the farmer and admin.</p>
                            </div>
                            <button type="submit" id="submitTransaction" disabled 
                                    class="bg-green-500 hover:bg-green-600 disabled:bg-gray-300 text-white font-bold py-3 px-8 rounded-lg transition-colors flex items-center space-x-2">
                                <span>📤</span>
                                <span>Complete Transaction & Send SMS</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Transaction Summary -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Transaction Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Grain Type:</span>
                            <span id="summary_grain" class="font-semibold">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Weight:</span>
                            <span id="summary_weight" class="font-semibold">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Unit Price:</span>
                            <span id="summary_price" class="font-semibold">-</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between text-lg">
                                <span class="font-bold">Total Amount:</span>
                                <span id="summary_total" class="font-bold text-green-600">K 0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Grain Prices -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Current Prices</h3>
                    <div class="space-y-3">
                        @foreach($grainTypes as $grainType)
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="font-semibold">{{ $grainType->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $grainType->unit }}</div>
                                </div>
                                <div class="font-bold text-green-600">{{ $grainType->formatted_price }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nrcSearch = document.getElementById('nrc_search');
    const searchBtn = document.getElementById('searchFarmer');
    const farmerDetails = document.getElementById('farmerDetails');
    const registerFarmer = document.getElementById('registerFarmer');
    const farmerInfo = document.getElementById('farmerInfo');
    const farmerIdInput = document.getElementById('farmer_id');
    const grainTypeSelect = document.getElementById('grain_type_id');
    const weightInput = document.getElementById('weight_kg');
    const submitBtn = document.getElementById('submitTransaction');

    // Search farmer
    searchBtn.addEventListener('click', function() {
        const nrc = nrcSearch.value.trim();
        if (!nrc) return;

        fetch(`/farmers/search/${encodeURIComponent(nrc)}`)
            .then(response => response.json())
            .then(data => {
                if (data.found) {
                    showFarmerDetails(data.farmer);
                } else {
                    showRegisterForm();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error searching for farmer');
            });
    });

    function showFarmerDetails(farmer) {
        farmerInfo.innerHTML = `
            <div><strong>Name:</strong> ${farmer.full_name}</div>
            <div><strong>Phone:</strong> ${farmer.phone_number}</div>
            <div><strong>Location:</strong> ${farmer.village}, ${farmer.district}</div>
        `;
        farmerIdInput.value = farmer.id;
        farmerDetails.classList.remove('hidden');
        registerFarmer.classList.add('hidden');
        checkFormValidity();
    }

    function showRegisterForm() {
        document.getElementById('full_name').value = '';
        registerFarmer.classList.remove('hidden');
        farmerDetails.classList.add('hidden');
    }

    // Register new farmer
    document.getElementById('registerFarmerBtn').addEventListener('click', function() {
        const formData = {
            nrc_number: nrcSearch.value.trim(),
            full_name: document.getElementById('full_name').value.trim(),
            phone_number: document.getElementById('phone_number').value.trim(),
            village: document.getElementById('village').value.trim(),
            district: document.getElementById('district').value.trim(),
            province: document.getElementById('province').value
        };

        if (!formData.full_name || !formData.phone_number || !formData.village || !formData.district || !formData.province) {
            alert('Please fill in all farmer details');
            return;
        }

        fetch('/farmers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showFarmerDetails(data.farmer);
                alert('Farmer registered successfully!');
            } else {
                alert('Error registering farmer');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error registering farmer');
        });
    });

    // Update transaction summary
    function updateSummary() {
        const grainType = grainTypeSelect.selectedOptions[0];
        const weight = parseFloat(weightInput.value) || 0;
        
        if (grainType && grainType.value) {
            const price = parseFloat(grainType.dataset.price);
            const total = (weight * price / 25).toFixed(2); // Convert to per kg
            
            document.getElementById('summary_grain').textContent = grainType.textContent.split(' - ')[0];
            document.getElementById('summary_weight').textContent = weight + ' kg';
            document.getElementById('summary_price').textContent = `K ${price.toFixed(2)} per 25kg`;
            document.getElementById('summary_total').textContent = `K ${total}`;
        }
    }

    function checkFormValidity() {
        const hasGrain = grainTypeSelect.value;
        const hasWeight = weightInput.value && parseFloat(weightInput.value) > 0;
        const hasFarmer = farmerIdInput.value;
        
        submitBtn.disabled = !(hasGrain && hasWeight && hasFarmer);
    }

    grainTypeSelect.addEventListener('change', updateSummary);
    weightInput.addEventListener('input', updateSummary);
    grainTypeSelect.addEventListener('change', checkFormValidity);
    weightInput.addEventListener('input', checkFormValidity);
});
</script>
@endpush
@endsection
