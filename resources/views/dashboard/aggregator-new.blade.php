@extends('layouts.app')

@section('title', 'Aggregator Dashboard - TENGELO')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">
        <i class="fas fa-warehouse text-tengelo-orange mr-3"></i>
        Aggregator Dashboard
    </h2>
    <p class="mt-1 text-sm text-gray-500">Manage your depot operations and farmer transactions.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-tengelo-green">
        <div class="flex items-center">
            <div class="p-2 bg-green-100 rounded">
                <i class="fas fa-users text-tengelo-green text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">My Farmers</p>
                <p class="text-2xl font-bold">15</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-tengelo-orange">
        <div class="flex items-center">
            <div class="p-2 bg-orange-100 rounded">
                <i class="fas fa-exchange-alt text-tengelo-orange text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Today's Transactions</p>
                <p class="text-2xl font-bold">8</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded">
                <i class="fas fa-money-bill text-blue-500 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Today Revenue</p>
                <p class="text-2xl font-bold">K24,800.00</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="p-2 bg-yellow-100 rounded">
                <i class="fas fa-clock text-yellow-500 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Pending Payments</p>
                <p class="text-2xl font-bold">3</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white shadow rounded-lg mb-8">
    <div class="px-6 py-4 border-b">
        <h3 class="text-lg font-medium">Recent Transactions</h3>
    </div>
    <div class="p-6">
        <p class="text-gray-500">Transaction data will be loaded here...</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h4 class="text-lg font-medium mb-2">Register Farmer</h4>
        <p class="text-sm text-gray-500 mb-4">Add a new farmer to your depot</p>
        <button class="bg-tengelo-green text-white px-4 py-2 rounded hover:bg-green-700">
            Add Farmer
        </button>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h4 class="text-lg font-medium mb-2">New Transaction</h4>
        <p class="text-sm text-gray-500 mb-4">Record grain purchase</p>
        <button class="bg-tengelo-orange text-white px-4 py-2 rounded hover:bg-orange-600">
            New Transaction
        </button>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h4 class="text-lg font-medium mb-2">Process Payments</h4>
        <p class="text-sm text-gray-500 mb-4">Handle farmer payments</p>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            View Payments
        </button>
    </div>
</div>
@endsection