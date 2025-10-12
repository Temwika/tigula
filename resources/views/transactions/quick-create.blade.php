@extends('layouts.app')

@section('title', 'Quick Grain Purchase - Tigula')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-orange-50 py-4">
    <div class="container mx-auto px-4 max-w-2xl">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">⚖️</span>
                        Quick Purchase
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">Farmer here with grain? Let's get them paid!</p>
                </div>
                <a href="{{ route('transactions.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-lg transition-all duration-200 text-sm">
                    ← Back
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('transactions.quick-store') }}" class="space-y-6">
            @csrf
            
            <!-- Quick Farmer Registration -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="text-2xl mr-2">👨‍🌾</span>
                    Farmer Details
                </h2>
                
                <div class="space-y-4">
                    <!-- Farmer Phone Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Farmer's Phone Number
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="farmer_phone" 
                                   name="farmer_phone"
                                   placeholder="+260 97 123 4567" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 text-lg">
                            <button type="button" 
                                    id="searchFarmer" 
                                    class="absolute right-2 top-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
                                Search
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Search existing farmer or register new one below</p>
                    </div>

                    <!-- Farmer Found Display -->
                    <div id="farmerFound" class="hidden bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-green-800" id="foundFarmerName"></p>
                                <p class="text-sm text-green-600" id="foundFarmerLocation"></p>
                            </div>
                            <span class="text-2xl">✅</span>
                        </div>
                        <input type="hidden" id="found_farmer_id" name="farmer_id">
                    </div>

                    <!-- New Farmer Registration -->
                    <div id="newFarmerForm" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" 
                                       name="farmer_name" 
                                       placeholder="Enter farmer's full name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Village</label>
                                <input type="text" 
                                       name="farmer_village" 
                                       placeholder="Village name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="text-2xl mr-2">⚖️</span>
                    Grain & Weight
                </h2>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Grain Type</label>
                            <select name="grain_type_id" id="grain_type_id" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 text-lg">
                                <option value="">What grain did they bring?</option>
                                @foreach($grainTypes as $grainType)
                                    <option value="{{ $grainType->id }}" data-price="{{ $grainType->current_price }}">
                                        {{ $grainType->name }} - K{{ number_format($grainType->current_price, 2) }}/{{ $grainType->unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Weight (kg)</label>
                            <input type="number" 
                                   name="weight_kg" 
                                   id="weight_kg" 
                                   step="0.1" 
                                   min="0.1" 
                                   required 
                                   placeholder="0.0" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 text-lg text-center font-bold">
                        </div>
                    </div>

                    <!-- Price Calculation Display -->
                    <div id="priceCalculation" class="bg-gradient-to-r from-green-50 to-orange-50 rounded-lg p-4 border border-green-200 hidden">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Amount</p>
                                <p class="text-2xl font-bold text-green-600" id="calculatedAmount">K 0.00</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Price per kg</p>
                                <p class="text-lg font-semibold text-gray-800" id="pricePerKg">K 0.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Depot Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Purchase Location</label>
                        <select name="depot_id" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                            <option value="">Where are you buying this?</option>
                            @foreach($depots as $depot)
                                <option value="{{ $depot->id }}">{{ $depot->name }} - {{ $depot->location }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Mobile Money Payment -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <span class="text-2xl mr-2">📱</span>
                    Mobile Money Payment
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Money Provider</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-orange-50 hover:border-orange-300">
                                <input type="radio" name="payment_method" value="Airtel Money" class="mr-3">
                                <span class="text-orange-600 font-semibold">🟠 Airtel Money</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-yellow-50 hover:border-yellow-300">
                                <input type="radio" name="payment_method" value="MTN Money" class="mr-3">
                                <span class="text-yellow-600 font-semibold">🟡 MTN Money</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-300">
                                <input type="radio" name="payment_method" value="Zamtel" class="mr-3">
                                <span class="text-blue-600 font-semibold">🔵 Zamtel</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Phone Number</label>
                        <input type="text" 
                               name="payment_phone" 
                               id="payment_phone"
                               placeholder="+260 97 123 4567" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 text-lg">
                        <p class="text-xs text-gray-500 mt-1">This will be filled automatically when you search farmer</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-4 px-6 rounded-lg text-lg shadow-lg transition-all duration-200 transform active:scale-95 disabled:opacity-50"
                        id="submitBtn">
                    <span class="flex items-center justify-center space-x-2">
                        <span>💰</span>
                        <span class="hidden sm:inline">Complete Purchase & Send Payment</span>
                        <span class="sm:hidden">Buy & Pay Now</span>
                    </span>
                </button>
                <p class="text-center text-sm text-gray-500 mt-2">
                    Farmer will receive SMS confirmation and instant mobile money payment
                </p>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const farmerPhoneInput = document.getElementById('farmer_phone');
    const paymentPhoneInput = document.getElementById('payment_phone');
    const searchBtn = document.getElementById('searchFarmer');
    const grainTypeSelect = document.getElementById('grain_type_id');
    const weightInput = document.getElementById('weight_kg');
    const priceCalculation = document.getElementById('priceCalculation');
    const calculatedAmount = document.getElementById('calculatedAmount');
    const pricePerKg = document.getElementById('pricePerKg');

    // Auto-fill payment phone when farmer phone is entered
    farmerPhoneInput.addEventListener('input', function() {
        paymentPhoneInput.value = this.value;
    });

    // Calculate price when grain type or weight changes
    function calculatePrice() {
        const selectedGrain = grainTypeSelect.options[grainTypeSelect.selectedIndex];
        const weight = parseFloat(weightInput.value) || 0;
        
        if (selectedGrain && selectedGrain.dataset.price && weight > 0) {
            const price = parseFloat(selectedGrain.dataset.price);
            const total = price * weight;
            
            calculatedAmount.textContent = `K ${total.toFixed(2)}`;
            pricePerKg.textContent = `K ${price.toFixed(2)}`;
            priceCalculation.classList.remove('hidden');
        } else {
            priceCalculation.classList.add('hidden');
        }
    }

    grainTypeSelect.addEventListener('change', calculatePrice);
    weightInput.addEventListener('input', calculatePrice);

    // Farmer search functionality (simplified for now)
    searchBtn.addEventListener('click', function() {
        const phone = farmerPhoneInput.value.trim();
        if (phone) {
            // TODO: Implement AJAX search for existing farmers
            console.log('Searching for farmer with phone:', phone);
        }
    });
});
</script>
@endsection