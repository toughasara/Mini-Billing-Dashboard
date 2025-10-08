@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Facture #{{ $invoice->invoice_number }}</h1>
        <div class="space-x-2">
            <a href="{{ route('invoices.edit', $invoice) }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                <i class="fas fa-edit mr-2"></i>Modifier
            </a>
            <a href="{{ route('invoices.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold mb-2">De :</h2>
                    <p class="font-bold">Votre Entreprise</p>
                    <p>123 Rue de l'Exemple</p>
                    <p>75001 Paris, France</p>
                    <p>contact@entreprise.com</p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Pour :</h2>
                    <p class="font-bold">{{ $invoice->customer->name }}</p>
                    <p>{{ $invoice->customer->company_name }}</p>
                    <p>{{ $invoice->customer->address }}</p>
                    <p>{{ $invoice->customer->email }}</p>
                    <p>{{ $invoice->customer->phone }}</p>
                </div>
            </div>
        </div>

        <div class="p-6 border-b border-gray-200">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Numéro</p>
                    <p class="font-semibold">#{{ $invoice->invoice_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Date</p>
                    <p class="font-semibold">{{ $invoice->invoice_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Échéance</p>
                    <p class="font-semibold">{{ $invoice->due_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Statut</p>
                    @php
                        $statusColors = [
                            'draft' => 'bg-gray-100 text-gray-800',
                            'sent' => 'bg-blue-100 text-blue-800', 
                            'paid' => 'bg-green-100 text-green-800',
                            'overdue' => 'bg-red-100 text-red-800'
                        ];
                        $statusLabels = [
                            'draft' => 'Brouillon',
                            'sent' => 'Envoyée',
                            'paid' => 'Payée', 
                            'overdue' => 'En Retard'
                        ];
                    @endphp
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$invoice->status] }}">
                        {{ $statusLabels[$invoice->status] }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Détails de la Facture</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Description</p>
                        <p class="font-semibold">{{ $invoice->description }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Quantité</p>
                        <p class="font-semibold">{{ $invoice->quantity }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Prix Unitaire</p>
                        <p class="font-semibold">{{ number_format($invoice->unit_price, 2, ',', ' ') }} €</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-50">
            <div class="flex justify-end">
                <div class="w-64">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-lg font-semibold">Total :</span>
                        <span class="text-lg font-bold">{{ number_format($invoice->total_amount, 2, ',', ' ') }} €</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($invoice->notes)
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-2">Notes</h3>
        <p class="text-gray-700">{{ $invoice->notes }}</p>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Actions</h3>
        <div class="flex flex-wrap gap-3">
            <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                <i class="fas fa-print mr-2"></i>Imprimer
            </button>
            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded" onclick="return confirm('Supprimer cette facture ?')">
                    <i class="fas fa-trash mr-2"></i>Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@media print {
    nav, footer, .bg-gray-100, [class*="bg-"]:not(.bg-white) {
        display: none !important;
    }
    body {
        background: white !important;
    }
    .bg-white {
        background: white !important;
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
}
</style>
@endsection