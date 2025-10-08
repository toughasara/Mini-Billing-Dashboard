@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">
        {{ isset($invoice) ? 'Modifier la Facture' : 'Nouvelle Facture' }}
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

    <form action="{{ isset($invoice) ? route('invoices.update', $invoice) : route('invoices.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @if(isset($invoice))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="invoice_number" class="block text-sm font-medium text-gray-700">Numéro de Facture *</label>
                <input type="text" name="invoice_number" id="invoice_number" 
                    value="{{ old('invoice_number', $invoice->invoice_number ?? 'FACT-' . date('Ymd-His')) }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Client *</label>
                <select name="customer_id" id="customer_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    <option value="">Sélectionnez un client</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" 
                            {{ old('customer_id', $invoice->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} - {{ $customer->email }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="invoice_date" class="block text-sm font-medium text-gray-700">Date de Facture *</label>
                <input type="date" name="invoice_date" id="invoice_date" 
                    value="{{ old('invoice_date', isset($invoice) ? $invoice->invoice_date->format('Y-m-d') : date('Y-m-d')) }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700">Date d'Échéance *</label>
                <input type="date" name="due_date" id="due_date" 
                    value="{{ old('due_date', isset($invoice) ? $invoice->due_date->format('Y-m-d') : date('Y-m-d', strtotime('+30 days'))) }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
            <input type="text" name="description" id="description" 
                value="{{ old('description', $invoice->description ?? '') }}" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" 
                placeholder="Description du service ou produit" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantité *</label>
                <input type="number" name="quantity" id="quantity" 
                    value="{{ old('quantity', $invoice->quantity ?? 1) }}" 
                    step="0.01" min="0.01" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label for="unit_price" class="block text-sm font-medium text-gray-700">Prix Unitaire (€) *</label>
                <input type="number" name="unit_price" id="unit_price" 
                    value="{{ old('unit_price', $invoice->unit_price ?? 0) }}" 
                    step="0.01" min="0" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700">Statut *</label>
            <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option value="draft" {{ old('status', $invoice->status ?? 'draft') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                <option value="sent" {{ old('status', $invoice->status ?? '') == 'sent' ? 'selected' : '' }}>Envoyée</option>
                <option value="paid" {{ old('status', $invoice->status ?? '') == 'paid' ? 'selected' : '' }}>Payée</option>
                <option value="overdue" {{ old('status', $invoice->status ?? '') == 'overdue' ? 'selected' : '' }}>En Retard</option>
            </select>
        </div>

        <div class="mb-6">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" id="notes" rows="3" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                    placeholder="Notes supplémentaires...">{{ old('notes', $invoice->notes ?? '') }}</textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('invoices.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                Annuler
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                {{ isset($invoice) ? 'Mettre à jour' : 'Créer la facture' }}
            </button>
        </div>
    </form>
</div>
@endsection