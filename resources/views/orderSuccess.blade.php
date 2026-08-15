<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling geslaagd</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center px-4">

    <div class="bg-white rounded-xl shadow-lg p-8 max-w-md text-center">

        <div class="mx-auto flex items-center justify-center w-20 h-20 bg-green-100 rounded-full">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mt-6">
            Bedankt voor je bestelling!
        </h1>

        <p class="text-gray-600 mt-3">
            Je betaling is succesvol ontvangen.
            We gaan je bestelling zo snel mogelijk verwerken.
        </p>

        <div class="mt-6 bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-500">
                Bestelnummer
            </p>

            <p class="text-xl font-semibold text-gray-800">
                #{{ request('order_id') }}
            </p>
        </div>

        <a href="{{ route('shop') }}"
           class="inline-block mt-6 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
            Terug naar winkel
        </a>

    </div>

</div>

</body>
</html>