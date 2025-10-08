@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">
        {{ isset($customer) ? 'Modifier le Client' : 'Nouveau Client' }}
    </h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($customer) ? route('customers.update', $customer) : route('customers.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @if(isset($customer))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $customer->name ?? '') }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $customer->email ?? '') }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone', $customer->phone ?? '') }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>

            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700">Entreprise</label>
                <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $customer->company_name ?? '') }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
            <textarea name="address" id="address" rows="3" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ old('address', $customer->address ?? '') }}</textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('customers.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                Annuler
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                {{ isset($customer) ? 'Mettre à jour' : 'Créer le client' }}
            </button>
        </div>
    </form>
</div>
@endsection