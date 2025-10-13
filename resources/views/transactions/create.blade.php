@extends('layouts.app')

@section('title', 'New Grain Purchase - Tigula')

@push('styles')
<style>
.form-container {
    background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
}

.form-step {
    background: white;
    border-radius: 16px;
    border: 2px solid #f0f2f5;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.form-step.active {
    border-color: var(--tigula-secondary);
    box-shadow: 0 8px 25px rgba(211, 84, 0, 0.15);
}

.form-step::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--tigula-gradient);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.form-step.active::before {
    opacity: 1;
}

.form-group-custom {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-label-custom {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-input-custom {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-input-custom:focus {
    border-color: var(--tigula-accent);
    box-shadow: 0 0 0 3px rgba(231, 126, 34, 0.1);
    outline: none;
}

.form-input-custom::placeholder {
    color: #adb5bd;
    font-style: italic;
}

.btn-custom {
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.btn-primary-custom {
    background: var(--tigula-gradient);
    color: white;
    min-width: 140px;
}

.btn-primary-custom:disabled {
    background: #adb5bd;
    cursor: not-allowed;
    transform: none;
}

.btn-success-custom {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
}

.btn-info-custom {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
}

.btn-warning-custom {
    background: var(--tigula-gradient-accent);
    color: white;
}

.farmer-card {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: 2px solid #28a745;
    border-radius: 16px;
    padding: 20px;
    margin-top: 20px;
    position: relative;
    overflow: hidden;
}

.farmer-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--tigula-gradient);
}

.summary-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    border: 2px solid #f8f9fa;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.price-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.price-item {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 15px;
    border-radius: 12px;
    border-left: 4px solid var(--tigula-accent);
}

.price-value {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--tigula-secondary);
}

.step-indicator {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-weight: bold;
    font-size: 0.9rem;
    margin-right: 12px;
    flex-shrink: 0;
}

.step-indicator.primary {
    background: var(--tigula-gradient);
    color: white;
}

.step-indicator.secondary {
    background: var(--tigula-gradient-accent);
    color: white;
}

.animation-slide-up {
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.required-field::after {
    content: ' *';
    color: #e74c3c;
    font-weight: bold;
}

@media (max-width: 768px) {
    .form-container {
        margin: 0;
        border-radius: 0;
    }

    .btn-custom {
        width: 100%;
        margin-bottom: 10px;
    }

    .summary-card {
        position: static;
        margin-top: 20px;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home me-1"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}"><i class="fas fa-exchange-alt me-1"></i>Transactions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-plus-circle me-2"></i>New Transaction
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">
                <i class="fas fa-plus-circle me-3"></i>New Grain Purchase
            </h1>
            <p class="text-muted">Create a new grain purchase transaction with farmer registration and instant mobile money payments.</p>
        </div>
    </div>
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

    <div class="row">
        <!-- Main Form Container -->
        <div class="col-xl-8 col-lg-7 col-md-12">
            <div class="card card-custom form-container">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-list-check me-2 text-primary"></i>Transaction Creation Steps
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form id="transactionForm" method="POST" action="{{ route('transactions.store') }}" novalidate>
                        @csrf

                        <!-- Step 1: Find or Register Farmer -->
                        <div class="form-step animation-slide-up" id="step1">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <span class="step-indicator primary">1</span>
                                    Find or Register Farmer
                                    <span class="required-field"></span>
                                </h3>

                                <div class="form-group-custom">
                                    <label for="nrc_search" class="form-label-custom required-field">Farmer NRC Number</label>
                                    <div class="input-group">
                                        <input type="text"
                                               id="nrc_search"
                                               class="form-input-custom"
                                               placeholder="Enter NRC number (e.g., 123456/78/1)"
                                               required>
                                        <button type="button"
                                                id="searchFarmer"
                                                class="btn btn-primary-custom">
                                            <i class="fas fa-search"></i>
                                            Search Farmer
                                        </button>
                                    </div>
                                    <small class="text-muted">We'll search for existing farmer or help you register a new one</small>
                                </div>

                                <!-- Farmer Details (Shown when found) -->
                                <div id="farmerDetails" class="farmer-card animation-slide-up" style="display: none;">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-check-circle text-success me-2 fs-4"></i>
                                        <h4 class="mb-0 text-success">Farmer Found!</h4>
                                    </div>
                                    <div id="farmerInfo" class="row g-3">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                    <input type="hidden" id="farmer_id" name="farmer_id">
                                    <div class="mt-3 pt-3 border-top">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Proceed to step 2 to complete the transaction
                                        </small>
                                    </div>
                                </div>

                                <!-- Register New Farmer Section (Shown when farmer not found) -->
                                <div id="registerFarmerSection" class="form-step animation-slide-up" style="display: none;">
                                    <div class="p-4 bg-light" style="border-radius: 12px;">
                                        <h4 class="mb-3">
                                            <i class="fas fa-user-plus me-2 text-primary"></i>
                                            Register New Farmer
                                        </h4>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <label for="full_name" class="form-label-custom required-field">Full Name</label>
                                                    <input type="text"
                                                           id="full_name"
                                                           class="form-input-custom"
                                                           placeholder="Enter farmer's full name"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <label for="phone_number" class="form-label-custom required-field">Phone Number</label>
                                                    <input type="tel"
                                                           id="phone_number"
                                                           class="form-input-custom"
                                                           placeholder="+260 XXX XXX XXX"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <label for="village" class="form-label-custom required-field">Village</label>
                                                    <input type="text"
                                                           id="village"
                                                           class="form-input-custom"
                                                           placeholder="Enter village name"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <label for="district" class="form-label-custom required-field">District</label>
                                                    <input type="text"
                                                           id="district"
                                                           class="form-input-custom"
                                                           placeholder="Enter district name"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group-custom">
                                                    <label for="province" class="form-label-custom required-field">Province</label>
                                                    <select id="province" class="form-input-custom" required>
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
                                            </div>
                                            <div class="col-12">
                                                <button type="button"
                                                        id="registerFarmerBtn"
                                                        class="btn btn-success-custom">
                                                    <i class="fas fa-user-check me-2"></i>
                                                    Register Farmer & Continue
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Transaction Details -->
                        <div class="form-step animation-slide-up" id="step2">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <span class="step-indicator secondary">2</span>
                                    Grain Transaction Details
                                    <span class="required-field"></span>
                                </h3>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="grain_type_id" class="form-label-custom required-field">Grain Type</label>
                                            <select name="grain_type_id" id="grain_type_id" class="form-input-custom" required>
                                                <option value="">Select grain type</option>
                                                @foreach($grainTypes as $grainType)
                                                    <option value="{{ $grainType->id }}" data-price="{{ $grainType->current_price }}">
                                                        {{ $grainType->name }} - ZMW {{ number_format($grainType->current_price, 2) }} per {{ $grainType->unit }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="depot_id" class="form-label-custom required-field">Collection Depot</label>
                                            <select name="depot_id" id="depot_id" class="form-input-custom" required>
                                                <option value="">Select depot location</option>
                                                @foreach($depots as $depot)
                                                    <option value="{{ $depot->id }}">{{ $depot->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="weight_kg" class="form-label-custom required-field">Grain Weight</label>
                                            <div class="input-group">
                                                <input type="number"
                                                       name="weight_kg"
                                                       id="weight_kg"
                                                       class="form-input-custom"
                                                       step="0.01"
                                                       min="1"
                                                       placeholder="Enter weight in kg"
                                                       required>
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <label for="quality_grade" class="form-label-custom">Grain Quality</label>
                                            <select name="quality_grade" id="quality_grade" class="form-input-custom">
                                                <option value="">Select quality grade</option>
                                                <option value="premium">Premium Grade (A+)</option>
                                                <option value="standard">Standard Grade (A)</option>
                                                <option value="commercial">Commercial Grade (B)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group-custom">
                                            <label for="notes" class="form-label-custom">Additional Notes</label>
                                            <textarea name="notes"
                                                      id="notes"
                                                      class="form-input-custom"
                                                      rows="3"
                                                      placeholder="Any additional details about the grain quality, condition, or special instructions..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Review & Submit -->
                        <div class="form-step animation-slide-up" id="step3">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <span class="step-indicator" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%); color: white;">3</span>
                                    Review & Confirm Transaction
                                </h3>

                                <div class="alert alert-info" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Almost done!</strong> Please review the transaction details below and click submit to complete the transaction and send SMS notifications.
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
<div class="col-xl-4 col-lg-5 col-md-12">
    <!-- Transaction Summary -->
    <div class="card card-custom summary-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-calculator me-2 text-primary"></i>Transaction Summary
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="summary-item">
                        <span class="summary-label">Grain Type:</span>
                        <span id="summary_grain" class="summary-value text-primary fw-bold">-</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="summary-item">
                        <span class="summary-label">Weight:</span>
                        <span id="summary_weight" class="summary-value fw-bold">0.00 kg</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="summary-item">
                        <span class="summary-label">Unit Price:</span>
                        <span id="summary_price" class="summary-value fw-bold">ZMW 0.00 per 25kg</span>
                    </div>
                </div>
                <div class="col-12">
                    <hr class="my-3">
                    <div class="summary-item final-total">
                        <span class="summary-label fw-bold fs-6">Total Amount:</span>
                        <span id="summary_total" class="summary-value fw-bold fs-4 text-success">ZMW 0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Grain Prices -->
    <div class="card card-custom mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-tags me-2 text-success"></i>Current Grain Prices
            </h5>
        </div>
        <div class="card-body">
            <div class="price-grid">
                @foreach($grainTypes as $grainType)
                <div class="price-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold text-primary">{{ $grainType->name }}</div>
                            <small class="text-muted">per {{ $grainType->unit }}</small>
                        </div>
                        <div class="price-value">
                            ZMW {{ number_format($grainType->current_price, 2) }}
                        </div>
                    </div>
                    @if($grainType->change_percentage != 0)
                    <small class="{{ $grainType->change_percentage > 0 ? 'text-success' : 'text-danger' }}">
                        <i class="fas fa-arrow-{{ $grainType->change_percentage > 0 ? 'up' : 'down' }}"></i>
                        {{ abs($grainType->change_percentage) }}% {{ $grainType->change_percentage > 0 ? 'increase' : 'decrease' }}
                    </small>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Farmer Information (Shows when selected) -->
    <div id="farmerSummary" class="card card-custom d-none">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-user-check me-2 text-success"></i>Selected Farmer
            </h5>
        </div>
        <div class="card-body">
            <div id="farmerSummaryContent">
                <!-- Populated by JavaScript -->
            </div>
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
