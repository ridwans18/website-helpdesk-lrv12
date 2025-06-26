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
            <h2 class="text-2xl font-semibold mb-4 text-center">Register Pengguna Baru</h2>
            
            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-medium mb-1">Nama</label>
                    <input type="text" name="name" required class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div>
                    <label class="block font-medium mb-1">Email</label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div>
                    <label class="block font-medium mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div>
                    <label class="block font-medium mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div>
                    <label class="block font-medium mb-1">Staff</label>
                    <select name="level" class="w-full border border-gray-300 rounded px-4 py-2" required>
                        <option value=""></option>
                        <option value="2">Admin Pengembang</option>
                        <option value="3">Admin Helpdesk</option>
                    </select>
                </div>
                <div class="text-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Daftar</button>
                </div>
            </form>
            <div>
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
        </div>

        <!-- Tabel Pengguna Terdaftar -->
        <div class="bg-white shadow-md rounded mt-10 p-6 max-w-4xl mx-auto">
            <h3 class="text-xl font-semibold mb-4 text-center">Daftar Pengguna</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Staff</th>
                            <th class="px-4 py-2 border">Tanggal Daftar</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">
                                @if ($user->level == 1)
                                    Super Admin
                                @elseif ($user->level == 2)
                                    Admin Pengembang
                                @elseif ($user->level == 3)
                                    Admin Helpdesk
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2 border">{{ $user->created_at->format('d-m-Y') }}</td>
                            <td class="flex gap-2 px-4 py-2 border">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada pengguna.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <x-footer />
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>
