@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-semibold text-gray-600">Total Clients</h2>
                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Customer::count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-file-invoice text-2xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-semibold text-gray-600">Total Factures</h2>
                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Invoice::count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-money-bill-wave text-2xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-semibold text-gray-600">Chiffre d'Affaires</h2>
                <p class="text-3xl font-bold text-gray-800">
                    {{ \App\Models\Invoice::where('status', 'paid')->sum('total_amount') }} €
                </p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Actions Rapides</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('customers.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg text-center block">
            <i class="fas fa-user-plus mr-2"></i>Nouveau Client
        </a>
        <a href="{{ route('invoices.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg text-center block">
            <i class="fas fa-file-invoice-dollar mr-2"></i>Nouvelle Facture
        </a>
    </div>
</div>
@endsection