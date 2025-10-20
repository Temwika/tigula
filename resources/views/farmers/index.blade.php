<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers - Grain Trading System</title>
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

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Registered Farmers</h2>
                <p class="mt-2 text-gray-600">Manage farmer registrations and information</p>
            </div>
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'aggregator')
                <a 
                    href="{{ route('farmers.create') }}" 
                    class="px-6 py-3 bg-gradient-to-r from-grain-orange to-grain-green text-white rounded-lg hover:from-grain-dark-green hover:to-grain-orange transition duration-300 shadow-lg"
                >
                    + Register Farmer
                </a>
            @endif
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

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <form method="GET" action="{{ route('farmers.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input 
                        type="text" 
                        id="search" 
                        name="search" 
                        value="{{ request('search') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent"
                        placeholder="Name, NRC, or phone..."
                    >
                </div>
                <div>
                    <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                    <input 
                        type="text" 
                        id="district" 
                        name="district" 
                        value="{{ request('district') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent"
                        placeholder="District..."
                    >
                </div>
                <div>
                    <label for="verified" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select 
                        id="verified" 
                        name="verified"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent"
                    >
                        <option value="">All Farmers</option>
                        <option value="1" {{ request('verified') == '1' ? 'selected' : '' }}>Verified</option>
                        <option value="0" {{ request('verified') == '0' ? 'selected' : '' }}>Unverified</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 bg-grain-orange text-white rounded-lg hover:bg-grain-dark-green transition duration-300"
                    >
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Farmers Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($farmers ?? [] as $farmer)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <!-- Farmer Header -->
                    <div class="bg-gradient-to-r from-grain-orange to-grain-green p-6">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                <span class="text-grain-orange text-2xl font-bold">👨‍🌾</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-white">{{ $farmer->full_name ?? 'Demo Farmer' }}</h3>
                                <p class="text-grain-light-orange">{{ $farmer->village ?? 'Demo Village' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Farmer Details -->
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">District:</span>
                                <span class="font-medium">{{ $farmer->district ?? 'Demo District' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Phone:</span>
                                <span class="font-medium">{{ $farmer->phone_number ?? '+260971234567' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">NRC:</span>
                                <span class="font-medium">{{ $farmer->nrc_number ?? '123456/12/1' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                @php
                                    $verified = $farmer->is_verified ?? true;
                                @endphp
                                @if($verified)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        ✓ Verified
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                        ⏳ Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Transaction Stats -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <p class="text-2xl font-bold text-grain-orange">{{ $farmer->transactions_count ?? rand(1, 15) }}</p>
                                    <p class="text-sm text-gray-600">Transactions</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-grain-green">K{{ number_format($farmer->total_earnings ?? rand(5000, 50000), 0) }}</p>
                                    <p class="text-sm text-gray-600">Total Earned</p>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 flex space-x-2">
                            <a 
                                href="{{ route('farmers.show', $farmer->id ?? 1) }}" 
                                class="flex-1 px-4 py-2 bg-grain-orange text-white rounded-lg hover:bg-grain-dark-green transition duration-300 text-center"
                            >
                                View Profile
                            </a>
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'aggregator')
                                <a 
                                    href="{{ route('farmers.transactions', $farmer->id ?? 1) }}" 
                                    class="flex-1 px-4 py-2 border border-grain-green text-grain-green rounded-lg hover:bg-grain-green hover:text-white transition duration-300 text-center"
                                >
                                    Transactions
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Demo Farmers -->
                @for($i = 1; $i <= 6; $i++)
                    @php
                        $demoFarmers = [
                            ['name' => 'John Mwansa', 'village' => 'Choma Village', 'district' => 'Choma', 'phone' => '+260971234567', 'nrc' => '123456/12/1', 'verified' => true, 'transactions' => 12, 'earnings' => 45000],
                            ['name' => 'Mary Tembo', 'village' => 'Lusaka Rural', 'district' => 'Lusaka', 'phone' => '+260977654321', 'nrc' => '234567/11/1', 'verified' => true, 'transactions' => 8, 'earnings' => 32000],
                            ['name' => 'Peter Banda', 'village' => 'Kabwe Central', 'district' => 'Kabwe', 'phone' => '+260963456789', 'nrc' => '345678/10/1', 'verified' => false, 'transactions' => 3, 'earnings' => 12000],
                            ['name' => 'Grace Mulenga', 'village' => 'Kitwe East', 'district' => 'Kitwe', 'phone' => '+260955123456', 'nrc' => '456789/09/1', 'verified' => true, 'transactions' => 15, 'earnings' => 58000],
                            ['name' => 'James Phiri', 'village' => 'Ndola South', 'district' => 'Ndola', 'phone' => '+260967890123', 'nrc' => '567890/08/1', 'verified' => true, 'transactions' => 6, 'earnings' => 23000],
                            ['name' => 'Sarah Zulu', 'village' => 'Livingstone West', 'district' => 'Livingstone', 'phone' => '+260978901234', 'nrc' => '678901/07/1', 'verified' => false, 'transactions' => 2, 'earnings' => 8500]
                        ];
                        $farmer = (object) $demoFarmers[$i-1];
                    @endphp
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <!-- Farmer Header -->
                        <div class="bg-gradient-to-r from-grain-orange to-grain-green p-6">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <span class="text-grain-orange text-2xl font-bold">👨‍🌾</span>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-white">{{ $farmer->name }}</h3>
                                    <p class="text-grain-light-orange">{{ $farmer->village }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Farmer Details -->
                        <div class="p-6">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">District:</span>
                                    <span class="font-medium">{{ $farmer->district }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Phone:</span>
                                    <span class="font-medium">{{ $farmer->phone }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">NRC:</span>
                                    <span class="font-medium">{{ $farmer->nrc }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    @if($farmer->verified)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                            ✓ Verified
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                            ⏳ Pending
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Transaction Stats -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="grid grid-cols-2 gap-4 text-center">
                                    <div>
                                        <p class="text-2xl font-bold text-grain-orange">{{ $farmer->transactions }}</p>
                                        <p class="text-sm text-gray-600">Transactions</p>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-grain-green">K{{ number_format($farmer->earnings, 0) }}</p>
                                        <p class="text-sm text-gray-600">Total Earned</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-6 flex space-x-2">
                                <a 
                                    href="#" 
                                    class="flex-1 px-4 py-2 bg-grain-orange text-white rounded-lg hover:bg-grain-dark-green transition duration-300 text-center"
                                >
                                    View Profile
                                </a>
                                <a 
                                    href="#" 
                                    class="flex-1 px-4 py-2 border border-grain-green text-grain-green rounded-lg hover:bg-grain-green hover:text-white transition duration-300 text-center"
                                >
                                    Transactions
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>

        <!-- Pagination -->
        @if(isset($farmers) && method_exists($farmers, 'links'))
            <div class="mt-8">
                {{ $farmers->links() }}
            </div>
        @endif
    </div>
</body>
</html>