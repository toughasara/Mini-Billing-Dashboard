<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Billing Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold">
                    <i class="fas fa-receipt mr-2"></i>Billing Dashboard
                </h1>
                <div class="space-x-4">
                    <a href="{{ route('customers.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Clients</a>
                    <a href="{{ route('invoices.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Factures</a>
                    <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto px-4 text-center">
            &copy; {{ date('Y') }} Mini Billing Dashboard - Laravel
        </div>
    </footer>
</body>
</html>