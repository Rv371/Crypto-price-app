<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Tracker</title>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-6 text-center">Live Cryptocurrency Tracker</h1>

        <!-- Add New Coin Form -->
        <form id="add-coin-form" class="mb-8">
            <div class="flex">
                <input type="text" id="coin-symbol" placeholder="Enter symbol (e.g., BTC-USDT)" 
                    class="border rounded p-2 flex-grow mr-2" required>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Coin</button>
            </div>
        </form>

        <!-- Coin Prices Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-200">
                    <tr class="text-left">
                        <th class="px-4 py-2">Cryptocurrency</th>
                        <th class="px-4 py-2">Price (USDT)</th>
                    </tr>
                </thead>
                <tbody id="crypto-table-body">
                    @foreach ($prices as $symbol => $price)
                        <tr id="{{ $symbol }}-row" data-symbol="{{ $symbol }}" class="border-t">
                            <td class="px-4 py-2">{{ $symbol }}</td>
                            <td id="{{ $symbol }}-price" class="px-4 py-2 text-green-500 font-semibold">
                                {{ $price }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
