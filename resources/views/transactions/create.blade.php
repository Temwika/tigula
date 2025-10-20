<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transaction - Grain Trading System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'grain-orange': '#FF8C00',
                        'grain-green': '#228B22',
                        'grain-light-orange': '#FFB84D',
                        'grain-dark-green': '#006400'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Header -->
    <nav class="bg-gradient-to-r from-grain-orange to-grain-green shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <span class="text-grain-orange text-lg font-bold">🌾</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-xl font-bold text-white">Grain Trading System</h1>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-grain-light-orange transition duration-300">
                        Dashboard
                    </a>
                    <span class="text-white">{{ Auth::user()->name }}</span>
                    <span class="px-3 py-1 bg-white bg-opacity-20 rounded-full text-sm text-white">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-grain-light-orange transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Create New Transaction</h2>
            <p class="mt-2 text-gray-600">Record a new grain purchase from a farmer</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-grain-green text-white p-4 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-500 text-white p-4 rounded-lg shadow">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <ul class="text-red-600 text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Transaction Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Farmer Selection -->
                    <div>
                        <label for="farmer_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Farmer <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="farmer_id" 
                            name="farmer_id" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('farmer_id') border-red-500 @enderror"
                        >
                            <option value="">Choose a farmer...</option>
                            @foreach($farmers as $farmer)
                                <option value="{{ $farmer->id }}" {{ old('farmer_id') == $farmer->id ? 'selected' : '' }}>
                                    {{ $farmer->full_name }} - {{ $farmer->village }}
                                </option>
                            @endforeach
                        </select>
                        @error('farmer_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grain Type -->
                    <div>
                        <label for="grain_type_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Grain Type <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="grain_type_id" 
                            name="grain_type_id" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('grain_type_id') border-red-500 @enderror"
                        >
                            <option value="">Select grain type...</option>
                            @foreach($grainTypes as $grainType)
                                <option value="{{ $grainType->id }}" data-price="{{ $grainType->current_price }}" {{ old('grain_type_id') == $grainType->id ? 'selected' : '' }}>
                                    {{ $grainType->name }} - K{{ number_format($grainType->current_price, 2) }}/kg
                                </option>
                            @endforeach
                        </select>
                        @error('grain_type_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Depot -->
                    <div>
                        <label for="depot_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Depot <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="depot_id" 
                            name="depot_id" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('depot_id') border-red-500 @enderror"
                        >
                            <option value="">Select depot...</option>
                            @foreach($depots as $depot)
                                <option value="{{ $depot->id }}" {{ old('depot_id') == $depot->id ? 'selected' : '' }}>
                                    {{ $depot->name }} - {{ $depot->location }}
                                </option>
                            @endforeach
                        </select>
                        @error('depot_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Weight -->
                    <div>
                        <label for="weight_kg" class="block text-sm font-medium text-gray-700 mb-2">
                            Weight (kg) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="weight_kg" 
                            name="weight_kg" 
                            step="0.01" 
                            min="0.01"
                            required 
                            value="{{ old('weight_kg') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('weight_kg') border-red-500 @enderror"
                            placeholder="Enter weight in kilograms"
                        >
                        @error('weight_kg')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price per kg -->
                    <div>
                        <label for="price_per_kg" class="block text-sm font-medium text-gray-700 mb-2">
                            Price per kg (K) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="price_per_kg" 
                            name="price_per_kg" 
                            step="0.01" 
                            min="0.01"
                            required 
                            value="{{ old('price_per_kg') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('price_per_kg') border-red-500 @enderror"
                            placeholder="Price per kilogram"
                        >
                        @error('price_per_kg')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Transaction Date -->
                    <div>
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Transaction Date <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="transaction_date" 
                            name="transaction_date" 
                            required 
                            value="{{ old('transaction_date', date('Y-m-d')) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('transaction_date') border-red-500 @enderror"
                        >
                        @error('transaction_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Total Amount Display -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-700">Total Amount:</span>
                        <span id="total_amount" class="text-2xl font-bold text-grain-green">K0.00</span>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes (Optional)
                    </label>
                    <textarea 
                        id="notes" 
                        name="notes" 
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent @error('notes') border-red-500 @enderror"
                        placeholder="Any additional notes about this transaction..."
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('transactions.index') }}" 
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300"
                    >
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-grain-orange to-grain-green text-white rounded-lg hover:from-grain-dark-green hover:to-grain-orange transition duration-300 shadow-lg"
                    >
                        Create Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-calculate total amount
        function calculateTotal() {
            const weight = parseFloat(document.getElementById('weight_kg').value) || 0;
            const price = parseFloat(document.getElementById('price_per_kg').value) || 0;
            const total = weight * price;
            document.getElementById('total_amount').textContent = 'K' + total.toFixed(2);
        }

        // Auto-fill price when grain type is selected
        document.getElementById('grain_type_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            if (price) {
                document.getElementById('price_per_kg').value = price;
                calculateTotal();
            }
        });

        // Calculate total when weight or price changes
        document.getElementById('weight_kg').addEventListener('input', calculateTotal);
        document.getElementById('price_per_kg').addEventListener('input', calculateTotal);

        // Initial calculation
        calculateTotal();
    </script>
</body>
</html>