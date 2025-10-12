@extends('layouts.app')

@section('title', 'Farmers - Tigula')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-orange-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <span class="text-3xl mr-3">👨‍🌾</span>
                        Small-Scale Farmers Network
                    </h1>
                    <p class="text-gray-600 mt-2">Connect with small-scale grain producers in rural Eastern Province - Sinda District Pilot Project</p>
                    <div class="flex items-center mt-3 text-sm">
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium mr-3">🌾 Pilot Area: Sinda District</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium">📍 Eastern Province Focus</span>
                    </div>
                </div>
                <a href="{{ route('farmers.create') }}" 
                   class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-200 flex items-center space-x-2">
                    <span>➕</span>
                    <span>Add New Farmer</span>
                </a>
            </div>
        </div>

        <!-- Sinda District Pilot Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">👥</div>
                <div class="text-2xl font-bold text-gray-800">287</div>
                <div class="text-gray-500">Small-Scale Farmers</div>
                <div class="text-xs text-gray-400 mt-1">Sinda District</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">🏘️</div>
                <div class="text-2xl font-bold text-green-600">24</div>
                <div class="text-gray-500">Rural Villages</div>
                <div class="text-xs text-gray-400 mt-1">Connected</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">🌾</div>
                <div class="text-2xl font-bold text-orange-600">5,847</div>
                <div class="text-gray-500">Bags Available</div>
                <div class="text-xs text-gray-400 mt-1">Current Season</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="text-3xl mb-2">�</div>
                <div class="text-2xl font-bold text-blue-600">89%</div>
                <div class="text-gray-500">Mobile Reach</div>
                <div class="text-xs text-gray-400 mt-1">SMS Coverage</div>
            </div>
        </div>

        <!-- Farmers Grid -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Active Farmers</h2>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search farmers..." 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option>All Locations</option>
                        <option>Lusaka</option>
                        <option>Copperbelt</option>
                        <option>Central Province</option>
                    </select>
                </div>
            </div>

            <!-- Small-Scale Farmers from Sinda District -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Farmer Card 1 - Mkaika Village -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-green-50 to-white">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            JT
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Joseph Tembo</h3>
                            <p class="text-sm text-gray-500">📍 Mkaika Village, Sinda</p>
                            <p class="text-xs text-green-600 font-medium">Small-Scale Farmer</p>
                        </div>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Maize Available:</span>
                            <span class="font-semibold">45 bags</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Farm Size:</span>
                            <span class="font-semibold text-blue-600">2.5 hectares</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Experience:</span>
                            <span class="text-yellow-500">⭐⭐⭐⭐⭐ 15 years</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobile:</span>
                            <span class="font-semibold text-green-600">+260 97X-XXX-XXX</span>
                        </div>
                    </div>
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Connect with Joseph
                    </button>
                </div>

                <!-- Farmer Card 2 - Nyimba Village -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-orange-50 to-white">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            MM
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Margaret Mwanza</h3>
                            <p class="text-sm text-gray-500">📍 Nyimba Village, Sinda</p>
                            <p class="text-xs text-orange-600 font-medium">Women's Cooperative Leader</p>
                        </div>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Groundnuts Available:</span>
                            <span class="font-semibold">32 bags</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Farm Size:</span>
                            <span class="font-semibold text-blue-600">1.8 hectares</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Group Members:</span>
                            <span class="text-purple-500">👥 12 women</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobile:</span>
                            <span class="font-semibold text-green-600">+260 96X-XXX-XXX</span>
                        </div>
                    </div>
                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Connect with Margaret
                    </button>
                </div>

                <!-- Farmer Card 3 - Kakoma Village -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-blue-50 to-white">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            BN
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Brighton Nyirenda</h3>
                            <p class="text-sm text-gray-500">📍 Kakoma Village, Sinda</p>
                            <p class="text-xs text-blue-600 font-medium">Youth Farmer (28 years)</p>
                        </div>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mixed Grains:</span>
                            <span class="font-semibold">28 bags</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Farm Size:</span>
                            <span class="font-semibold text-blue-600">3.2 hectares</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Innovation:</span>
                            <span class="text-green-500">🌱 Climate-Smart</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobile:</span>
                            <span class="font-semibold text-green-600">+260 95X-XXX-XXX</span>
                        </div>
                    </div>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Connect with Brighton
                    </button>
                </div>

                <!-- Farmer Card 4 - Chikumbi Village -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-purple-50 to-white">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            AK
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Agnes Kachepa</h3>
                            <p class="text-sm text-gray-500">📍 Chikumbi Village, Sinda</p>
                            <p class="text-xs text-purple-600 font-medium">Sunflower Specialist</p>
                        </div>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sunflower:</span>
                            <span class="font-semibold">38 bags</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Farm Size:</span>
                            <span class="font-semibold text-blue-600">2.1 hectares</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Quality:</span>
                            <span class="text-yellow-500">⭐⭐⭐⭐⭐ Premium</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobile:</span>
                            <span class="font-semibold text-green-600">+260 97X-XXX-XXX</span>
                        </div>
                    </div>
                    <button class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Connect with Agnes
                    </button>
                </div>

                <!-- Farmer Card 5 - Mwami Village -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-indigo-50 to-white">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            DS
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Daniel Sakala</h3>
                            <p class="text-sm text-gray-500">📍 Mwami Village, Sinda</p>
                            <p class="text-xs text-indigo-600 font-medium">Conservation Farmer</p>
                        </div>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Soybean:</span>
                            <span class="font-semibold">41 bags</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Farm Size:</span>
                            <span class="font-semibold text-blue-600">2.8 hectares</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Method:</span>
                            <span class="text-green-500">🌿 No-Till</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobile:</span>
                            <span class="font-semibold text-green-600">+260 96X-XXX-XXX</span>
                        </div>
                    </div>
                    <button class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Connect with Daniel
                    </button>
                </div>

                <!-- Farmer Card 6 - Kapamba Village -->
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-pink-50 to-white">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            EM
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">Elizabeth Mulenga</h3>
                            <p class="text-sm text-gray-500">📍 Kapamba Village, Sinda</p>
                            <p class="text-xs text-pink-600 font-medium">Organic Farming Advocate</p>
                        </div>
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Organic Maize:</span>
                            <span class="font-semibold">35 bags</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Farm Size:</span>
                            <span class="font-semibold text-blue-600">2.3 hectares</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Certification:</span>
                            <span class="text-green-500">🏅 Organic</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Mobile:</span>
                            <span class="font-semibold text-green-600">+260 95X-XXX-XXX</span>
                        </div>
                    </div>
                    <button class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 rounded-lg transition-colors duration-200">
                        Connect with Elizabeth
                    </button>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    Showing 1-6 of 287 small-scale farmers in Sinda District
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Previous</button>
                    <button class="px-3 py-2 bg-green-500 text-white rounded-lg">1</button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                    <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
