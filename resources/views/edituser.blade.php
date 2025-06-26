<!DOCTYPE html>
<html class="h-full bg-gray-100">
<head>
    <title>Register User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen">
    <div class="min-h-full">
        <x-navbar :links="[
            ['href' => '/', 'text' => 'Home'],
            ['href' => 'beranda', 'text' => 'Beranda'],
            ['href' => 'daftarkeluhan', 'text' => 'Daftar Keluhan'],
            ['href' => 'laporan', 'text' => 'Laporan'],
            ['href' => 'register', 'text' => 'Kelola User', 'class' => 'text-white bg-gray-900'],
        ]" />
    </div>

    <main class="flex-grow container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded p-6 max-w-2xl mx-auto">
            <h2 class="text-2xl font-semibold mb-4 text-center">Edit Pengguna</h2>
            
            <div class="mt-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ route('user.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-medium mb-1">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}" required class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div>
                    <label class="block font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div>
                    <label class="block font-medium mb-1">Password</label>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div>
                    <label class="block font-medium mb-1">Staff</label>
                    <select name="level" required class="w-full border border-gray-300 rounded px-4 py-2">
                        {{-- <option value="1" {{ $user->level == 1 ? 'selected' : '' }}>Super Admin</option> --}}
                        <option value="2" {{ $user->level == 2 ? 'selected' : '' }}>Admin Pengembang</option>
                        <option value="3" {{ $user->level == 3 ? 'selected' : '' }}>Admin Helpdesk</option>
                    </select>
                </div>

                <div class="w-full flex justify-between items-center">
                    <button href="{{ route('register') }}" class="inline-block mt-4 text-blue-600 text-start">← Kembali ke Daftar Pengguna</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-end">Update</button>
                </div>
            </form>
        </div>
    </main>

    <x-footer />
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>
