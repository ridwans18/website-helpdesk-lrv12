{{-- @if(session('error'))
    <p class="text-red-600 text-center mt-4">{{ session('error') }}</p>
@endif --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Helpdesk Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-100 to-indigo-200 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/login" class="text-md font-bold text-gray-800 truncate">Helpdesk</a>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="flex-grow flex items-center justify-center pt-20">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-center text-gray-700 mb-6">Masuk</h3>

            <form method="POST" action="{{ route('login.proses') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" name="email" id="email" placeholder="name@example.com" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="Password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="flex flex-col items-center space-y-4">
                    <button type="submit"
                        class=" bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-md transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="24" fill="currentColor"
                            class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708" />
                            <path fill-rule="evenodd"
                                d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </button>

                    <a href="#" class="text-sm text-gray-500 hover:text-gray-700 font-bold">Lupa password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
