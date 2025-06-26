<!DOCTYPE html>
<html class="h-full bg-gray-100">
    <head>
        <title>Dashboard Helpdesk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="flex flex-col min-h-screen d-flex flex-column min-vh-100">
        @php
            $user = Auth::user();
            $navbarLinks = [
                ['href' => route('dashboard'), 'class' => 'text-white bg-gray-900', 'text' => 'Home'],
                ['href' => 'beranda', 'text' => 'Beranda'],
                ['href' => 'daftarkeluhan', 'text' => 'Daftar Keluhan'],
                ['href' => 'laporan', 'text' => 'Laporan'],
            ];

            if ($user && $user->level == 1) {
                $navbarLinks[] = ['href' => 'register', 'text' => 'Kelola User'];
            }
        @endphp

        <div class="min-h-full">
            <x-navbar :links="$navbarLinks" />
        </div>        
        <main class="flex-grow container mx-auto px-4 py-6">
            <div class="mx-auto">
                <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

                {{-- Filter Bulan --}}
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col sm:flex-row sm:items-end sm:gap-4 gap-2">
                    <div class="w-full sm:w-auto">
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Pilih Bulan:</label>
                        <select name="bulan" id="bulan"
                            class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">Semua Bulan</option>
                            @foreach($bulanList as $num => $nama)
                                <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                                    {{ $nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full sm:w-auto">
                        <button type="submit"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm">
                            Tampilkan
                        </button>
                    </div>
                    <div class="sm:ml-auto w-full sm:w-auto mt-3">
                        <div class="bg-red-100 text-red-700 font-semibold px-4 py-2 rounded shadow-md text-center">
                            Overdue: {{ $jumlahOverdue }}
                        </div>
                    </div>
                </form>

                {{-- Bar Chart Keluhan per Bulan --}}
                @if(is_countable($keluhanPerBulan) && count($keluhanPerBulan) > 0)
                <div class="relative w-full overflow-x-auto mb-7 bg-white p-4 rounded shadow mt-3" style="min-height: 300px;">
                    <canvas id="keluhanChart" style="height: 400px;"></canvas>
                </div>
                <script>
                    const data = @json($keluhanPerBulan->groupBy('kategori'));
                    const bulanMap = {
                        1: 'Jan', 2: 'Feb', 3: 'Mar', 4: 'Apr',
                        5: 'May', 6: 'Jun', 7: 'Jul', 8: 'Aug',
                        9: 'Sep', 10: 'Oct', 11: 'Nov', 12: 'Dec'
                    };

                    const labels = [...new Set(Object.values(data).flatMap(k => 
                        k.map(i => bulanMap[i.bulan] || `Bulan ${i.bulan}`)
                    ))];

                    const datasets = Object.entries(data).map(([kategori, entri]) => ({
                        label: kategori,
                        data: labels.map(label => {
                            const bulan = Object.keys(bulanMap).find(key => bulanMap[key] === label);
                            const entry = entri.find(e => e.bulan == bulan);
                            return entry ? entry.jumlah : 0;
                        }),
                        backgroundColor: '#' + Math.floor(Math.random() * 16777215).toString(16)
                    }));

                    const ctx = document.getElementById('keluhanChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets,
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Jumlah Keluhan per Bulan Berdasarkan Kategori'
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        stepSize: 1,
                                        precision: 0,
                                        beginAtZero: true,
                                        callback: function(value) {
                                            return Number.isInteger(value) ? value : null;
                                        }
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                </script>
                @else
                    <p class="text-gray-600">Tidak ada data keluhan untuk bulan yang dipilih.</p>
                @endif
            </div>

            {{-- Pie + Line Chart --}}
            <div class="flex flex-col md:flex-row gap-6 mb-9">
                {{-- Pie Chart Keluhan Selesai per Teknisi --}}
                <div class="md:w-1/3 w-full bg-white p-4 rounded shadow">
                    @if(count($keluhanSelesaiPerTeknisi) > 0)
                    <canvas id="pieChart" width="260" height="260" class="mx-auto"></canvas>
                    <script>
                        const teknisiSelesai = @json($keluhanSelesaiPerTeknisi);
                        const teknisiLabels = Object.keys(teknisiSelesai);
                        const teknisiData = Object.values(teknisiSelesai);

                        new Chart(document.getElementById('pieChart'), {
                            type: 'pie',
                            data: {
                                labels: teknisiLabels,
                                datasets: [{
                                    data: teknisiData,
                                    backgroundColor: teknisiLabels.map(() =>
                                        '#' + Math.floor(Math.random() * 16777215).toString(16)
                                    )
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Keluhan Selesai per Teknisi'
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    </script>
                    @else
                        <p class="text-gray-500">Tidak ada data keluhan yang selesai untuk ditampilkan.</p>
                    @endif
                </div>

                {{-- Line Chart Keluhan per Bulan --}}
                <div class="w-full overflow-x-auto bg-white p-4 rounded shadow">
                    <div class="w-full">
                        <canvas id="mingguChart" height="260" class="w-full"></canvas>
                    </div>
                    <script>
                        const mingguData = @json($keluhanPerBulanSimple); // <- Ganti datanya ke data per bulan

                        if (mingguData.length > 0) {
                            const bulanMap = {
                                1: 'Jan', 2: 'Feb', 3: 'Mar', 4: 'Apr',
                                5: 'May', 6: 'Jun', 7: 'Jul', 8: 'Aug',
                                9: 'Sep', 10: 'Oct', 11: 'Nov', 12: 'Dec'
                            };

                            // Label tiap bulan (tetap pakai nama "mingguLabels" agar tidak mengubah struktur lama)
                            const mingguLabels = Array.from({ length: 12 }, (_, i) => bulanMap[i + 1]);

                            // Data jumlah per bulan (tetap pakai nama "mingguJumlah" agar cocok dengan struktur lama)
                            const mingguJumlah = mingguLabels.map((label, index) => {
                                const bulan = index + 1;
                                const entry = mingguData.find(e => e.bulan == bulan);
                                return entry ? entry.jumlah : 0;
                            });

                            const ctx = document.getElementById('mingguChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: mingguLabels,
                                    datasets: [{
                                        label: 'Jumlah Keluhan',
                                        data: mingguJumlah,
                                        borderColor: 'rgb(75, 192, 192)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        fill: true,
                                        tension: 0.3
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Trenline Keluhan per Bulan (Jan - Des)'
                                        },
                                        legend: {
                                            position: 'bottom',
                                            display: true
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1,
                                                precision: 0
                                            },
                                            grid: {
                                                display: false
                                            }
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            },
                                            ticks: {
                                                maxRotation: 0,
                                                minRotation: 0,
                                                autoSkip: false
                                            }
                                        }
                                    }
                                }
                            });
                        } else {
                            console.warn('Tidak ada data keluhan bulanan');
                        }
                    </script>
                </div>
            </div>
        </main>

        <x-footer />
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>