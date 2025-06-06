<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FoodShare Hub</title>
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
<body>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
       
        <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-500 text-white shadow-lg relative z-10">
           
            <div class="p-6 flex items-center space-x-3 border-b border-green-400 border-opacity-30">
                <div class="rounded-full p-2 shadow-md">
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
                <h1 class="text-xl font-bold tracking-wide">FoodShare Hub</h1>
            </div>

           
            <nav class="mt-8 px-4">
                <div class="mb-6">
                    <p class="text-xs text-green-200 font-semibold uppercase tracking-wider mb-2 ml-4">Main Menu</p>
                    <a href="#" class="sidebar-link active flex items-center px-4 py-3 mb-2 bg-green-700 bg-opacity-50 rounded-lg font-medium">
                        <i class="fas fa-home mr-3 w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route ('admin.food-requests') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-hand-holding-heart mr-3 w-5 text-center"></i>
                        <span>Lihat Permintaan</span>
                    </a>
                    
                    <a href="{{ route('admin.history') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-history mr-3 w-5 text-center"></i>
                        <span>Riwayat</span>
                    </a>
                </div>
                
                <div class="mb-6">
                    <p class="text-xs text-green-200 font-semibold uppercase tracking-wider mb-2 ml-4">Settings</p>
                    <a href="{{ route('admin.settings') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
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
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
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
                   
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-amber-500 shadow-lg hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-sm font-semibold uppercase text-gray-500 mb-1">Total Pemesanan</h2>
                                <p class="text-4xl font-bold text-gray-800">{{ $totalRequests }}</p>
                            </div>
                            <div class="bg-amber-100 p-3 rounded-lg">
                                <i class="fas fa-clipboard-list text-2xl text-amber-600"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center {{ $totalRequestsDifference >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas {{ $totalRequestsDifference >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                            <span>{{ abs($totalRequestsDifference) }} pcs dari bulan lalu</span>
                        </div>
                    </div>
                    
                   
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-green-500 shadow-lg hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-sm font-semibold uppercase text-gray-500 mb-1">Pesanan yang disetujui {{ Auth::user()->name }}</h2>
                                <p class="text-4xl font-bold text-gray-800">{{ Auth::user()->approved }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-check-circle text-2xl text-green-600"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center {{ $approvedRequestsDifference >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            <i class="fas {{ $approvedRequestsDifference >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                            <span>{{ Auth::user()->approved }} pcs dari bulan lalu</span>
                        </div>
                    </div>
                    
                  
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-blue-500 shadow-lg hover:shadow-xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-sm font-semibold uppercase text-gray-500 mb-1">Connected Schools</h2>
                                <p class="text-4xl font-bold text-gray-800">{{ $connectedSchools }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-school text-2xl text-blue-600"></i>
                            </div>
                        </div>
                        <div class="mt-1 text-sm text-gray-500">
                            <span>Total Connected Schools</span>
                        </div>
                    </div>
                </div>
                
             
                <h2 class="text-xl font-bold text-gray-800 mb-4">Financial Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="stat-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl">
                        <div class="bg-gradient-to-r from-amber-500 to-amber-600 p-4 text-white">
                            <h2 class="font-semibold">Pengeluaran per Bulan</h2>
                        </div>
                        <div class="p-6 flex justify-between items-center">
                            <p class="text-4xl font-bold text-gray-800">Rp 100 jt</p>
                            <div class="bg-amber-100 p-3 rounded-full">
                                <i class="fas fa-hand-holding-dollar text-2xl text-amber-600"></i>
                            </div>
                        </div>
                        <div class="px-6 pb-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-amber-500 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">65% dari anggaran tahunan</p>
                        </div>
                    </div>
                    
                   
                    <div class="stat-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4 text-white">
                            <h2 class="font-semibold">Total Pengeluaran</h2>
                        </div>
                        <div class="p-6 flex justify-between items-center">
                            <p class="text-4xl font-bold text-gray-800">Rp 350 jt</p>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-circle-dollar-to-slot text-2xl text-purple-600"></i>
                            </div>
                        </div>
                        <div class="px-6 pb-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-500 h-2 rounded-full" style="width: 80%"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">80% dari total anggaran</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>