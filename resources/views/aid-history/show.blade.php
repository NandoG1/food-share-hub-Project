<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permintaan - FoodShare Hub</title>
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
                    <a href="{{ route('food-requests.index') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 bg-opacity-50 rounded-lg text-white font-medium">
                        <i class="fas fa-list-check mr-3 w-5 text-center"></i>
                        <span>Status Permintaan</span>
                    </a>
                    <a href="{{ route('aid-history.index') }}" class="sidebar-link active flex items-center px-4 py-3 mb-2 bg-green-700 bg-opacity-50 rounded-lg transition-colors">
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
                <div class="flex items-center">
                    <a href="{{ route('aid-history.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Permintaan #{{ $foodRequest->id }}</h1>
                </div>
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
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                 
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Status Permintaan</h2>
                            </div>
                            <div>
                                @if($foodRequest->status == 'pending')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Menunggu
                                    </span>
                                @elseif($foodRequest->status == 'approved')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i> Disetujui
                                    </span>
                                @elseif($foodRequest->status == 'rejected')
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                 
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Informasi Sekolah</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->school_name }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Kontak Person</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->contact_person }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Telepon</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->phone_number }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Email</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->email }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Alamat</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->address }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Jumlah Siswa</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->student_count }} orang</p>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Tanggal Pengiriman</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->requested_date->format('d F Y') }}</p>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Tanggal Dibuat</h3>
                                    <p class="text-lg font-semibold text-gray-900">{{ $foodRequest->created_at->format('d F Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        @if($foodRequest->additional_notes)
                            <div class="mt-4">
                                <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Catatan Tambahan</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-800">{{ $foodRequest->additional_notes }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($foodRequest->status == 'rejected' && $foodRequest->rejection_reason)
                            <div class="mt-6">
                                <h3 class="text-xs font-medium text-red-500 uppercase tracking-wider mb-2">Alasan Penolakan</h3>
                                <div class="bg-red-50 p-4 rounded-lg border-l-4 border-red-500">
                                    <p class="text-red-800">{{ $foodRequest->rejection_reason }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                  
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between">
                        <a href="{{ route('aid-history.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors shadow-sm hover:shadow-md">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        
                        @if($foodRequest->status == 'pending')
                            <div class="text-sm text-gray-500 italic flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                Tim kami sedang meninjau permintaan Anda
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>