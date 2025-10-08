@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Gestion des Factures</h1>
    <a href="{{ route('invoices.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        <i class="fas fa-plus mr-2"></i>Nouvelle Facture
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Facture</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($invoices as $invoice)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">#{{ $invoice->invoice_number }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $invoice->customer->name }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-500">{{ Str::limit($invoice->description, 50) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ number_format($invoice->total_amount, 2, ',', ' ') }} €</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
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
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('invoices.show', $invoice) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('invoices.edit', $invoice) }}" class="text-green-600 hover:text-green-900 mr-3">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer cette facture ?')">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                    Aucune facture trouvée. <a href="{{ route('invoices.create') }}" class="text-blue-600 hover:text-blue-900">Créez la première facture</a>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection