
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Bantuan - FoodShare Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <style>
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .sidebar-link.active {
            position: relative;
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #fff;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
       
        <div class="w-64 bg-gradient-to-b from-green-600 to-green-500 text-white shadow-lg relative z-10">
           
            <div class="p-6 flex items-center space-x-3 border-b border-green-400 border-opacity-30">
                <div class="rounded-full p-2 shadow-md">
                     <i class="fa-solid fa-earth-americas"></i>
                </div>
                <h1 class="text-xl font-bold tracking-wide">FoodShare Hub</h1>
            </div>

 
            <nav class="mt-8 px-4">
                <div class="mb-6">
                    <p class="text-xs text-green-200 font-semibold uppercase tracking-wider mb-2 ml-4">Main Menu</p>
                    <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-home mr-3 w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('food-requests.create') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-hand-holding-heart mr-3 w-5 text-center"></i>
                        <span>Ajukan Permintaan</span>
                    </a>
                    <a href="{{ route('food-requests.index') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-list-check mr-3 w-5 text-center"></i>
                        <span>Status Permintaan</span>
                    </a>
                    <a href="{{ route('aid-history.index') }}" class="sidebar-link active flex items-center px-4 py-3 mb-2 bg-green-700 bg-opacity-50 rounded-lg text-white font-medium">
                        <i class="fas fa-history mr-3 w-5 text-center"></i>
                        <span>Riwayat Bantuan</span>
                    </a>
                </div>
                
                <div class="mb-6">
                    <p class="text-xs text-green-200 font-semibold uppercase tracking-wider mb-2 ml-4">Settings</p>
                    <a href="{{ route('settings.edit') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-cog mr-3 w-5 text-center"></i>
                        <span>Pengaturan</span>
                    </a>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                        <span>Sign Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </nav>
            
           
            <div class="absolute bottom-0 left-0 right-0 p-4">
                <div class="flex items-center space-x-3 bg-green-700 bg-opacity-30 p-3 rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-green-600">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="font-medium">{{ Auth::user()->name ?? 'User Name' }}</p>
                        <p class="text-xs text-green-200">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="flex-1">
           
            <header class="bg-white shadow-md p-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Riwayat Bantuan</h1>
                <div class="flex items-center space-x-4">
                    <button class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                        <i class="fas fa-bell text-gray-600"></i>
                    </button>
                    <div class="relative">
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-green-500"></span>
                        <button class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                            <i class="fas fa-envelope text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </header>
            
           
            <div class="p-8">
               
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                   
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-blue-500 shadow-lg hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-sm font-semibold uppercase text-gray-500 mb-1">Total Permintaan</h2>
                                <p class="text-4xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-clipboard-list text-2xl text-blue-600"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">{{ $stats['pending'] }} Menunggu</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">{{ $stats['approved'] }} Disetujui</span>
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">{{ $stats['rejected'] }} Ditolak</span>
                            </div>
                        </div>
                    </div>
                    
                   
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-purple-500 shadow-lg hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-sm font-semibold uppercase text-gray-500 mb-1">Sekolah Terlayani</h2>
                                <p class="text-4xl font-bold text-gray-800">{{ $stats['unique_schools'] }}</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <i class="fas fa-school text-2xl text-purple-600"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-gray-600">
                            <span>Sekolah yang terdaftar pada sistem</span>
                        </div>
                    </div>
                    
                    
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-green-500 shadow-lg hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-sm font-semibold uppercase text-gray-500 mb-1">Total Siswa Terlayani</h2>
                                <p class="text-4xl font-bold text-gray-800">{{ number_format($stats['total_students']) }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-user-graduate text-2xl text-green-600"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-green-600">
                            <i class="fas fa-utensils mr-1"></i>
                            <span>Layanan makanan yang sudah diberikan</span>
                        </div>
                    </div>
                </div>
                
               
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Filter Riwayat Bantuan</h2>
                    <form action="{{ route('aid-history.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 p-4">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_range" class="block text-sm font-medium text-gray-700 mb-1">Rentang Waktu</label>
                            <select id="date_range" name="date_range" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 p-4">
                                <option value="">Semua Waktu</option>
                                <option value="last-week" {{ $dateRange == 'last-week' ? 'selected' : '' }}>Minggu Terakhir</option>
                                <option value="last-month" {{ $dateRange == 'last-month' ? 'selected' : '' }}>Bulan Terakhir</option>
                                <option value="last-3-months" {{ $dateRange == 'last-3-months' ? 'selected' : '' }}>3 Bulan Terakhir</option>
                            </select>
                        </div>
                        <div>
                            <label for="school_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                            <input type="text" id="school_name" name="school_name" value="{{ $schoolName }}" placeholder="Cari nama sekolah..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 p-4">
                        </div>
                        <div class="md:col-span-3 flex justify-end space-x-4">
                            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </form>
                </div>
                
              
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 ">
                    <div class="flex gap-2 justify-around bg-white rounded-xl shadow-lg p-6 md:col-span-2">
                        <img src="Images/1.jpg" alt="" width="420px" class="rounded-xl">
                        <img src="Images/4.jpg" alt="" width="420px" class="rounded-xl">
                    </div>


                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Top 5 Sekolah</h2>
                        <div class="space-y-4">
                            @foreach($topSchools as $school)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium text-gray-700">{{ $school->school_name }}</span>
                                        <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded-full font-semibold">{{ $school->request_count }} permintaan</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
               
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-bold text-gray-800">Daftar Semua Permintaan Bantuan</h2>
                    </div>
                    
                    @if($foodRequests->isEmpty())
                        <div class="p-10 text-center">
                            <div class="text-gray-400 mb-4">
                                <i class="fas fa-file-circle-question text-6xl"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 mb-2">Tidak Ada Data</h3>
                            <p class="text-gray-500">Tidak ada permintaan makanan yang ditemukan dengan filter yang dipilih.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sekolah</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Permintaan</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Siswa</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Request</th>
                                        <th class="px-6 py-3 border-b border-gray-200 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($foodRequests as $request)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                #{{ $request->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $request->school_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ \Carbon\Carbon::parse($request->requested_date)->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $request->student_count }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($request->status == 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Menunggu
                                                    </span>
                                                @elseif($request->status == 'approved')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Disetujui
                                                    </span>
                                                @elseif($request->status == 'rejected')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $request->user->name ?? 'Unknown' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $request->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $request->school_request_count }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('aid-history.show', $request) }}" class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                     
                        <div class="px-6 py-4 border-t border-gray-200">
                            <!-- {{ $foodRequests->withQueryString()->links() }} -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
 
   
</body>
</html>