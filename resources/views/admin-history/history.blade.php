<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - FoodShare Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .stat-card {
            transition: all 0.3s ease !important;
            border-left: 4px solid transparent;
        }
        .stat-card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
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
        
        .status-pending {
            border-left-color:rgb(251, 191, 36);
        }
        .status-approved {
            border-left-color:rgb(52, 211, 153);
        }
        .status-rejected {
            border-left-color:rgb(239, 68, 68);
        }
        
        .status-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .badge-pending {
            background-color:rgb(232, 214, 144);
            color:rgb(146, 64, 14);
        }
        
        .badge-approved {
            background-color:rgb(174, 231, 202);
            color:rgb(6, 95, 70);
        }
        
        .badge-rejected {
            background-color:rgb(184, 146, 146);
            color:rgb(174, 28, 28);
        }
        
        .filter-btn {
            transition: all 0.2s;
            transform-origin: center;
        }
        
        .filter-btn:hover {
            transform: scale(1.05);
        }
        
        .filter-btn:active {
            transform: scale(0.98);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        #foodRequestModal {
            animation: fadeIn 0.3s ease-out;
        }
        
        #foodRequestModal .modal-content {
            animation: slideIn 0.3s ease-out;
        }
    </style>
</head>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("foodRequestModal");
        const closeModalBtn = document.getElementById("closeModal");

        function openModal(requestData) {
            modal.classList.remove("hidden");

            modal.querySelector("ul").innerHTML = `
                <li class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <span class="text-black font-medium">Nama Sekolah:</span> 
                        <p class="text-gray-700">${requestData.school_name}</p>
                    </div>
                    <div class="col-span-2">
                        <span class="text-black font-medium">Contact Person:</span> 
                        <p class="text-gray-700">${requestData.contact_person}</p>
                    </div>
                </li>
                <li class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <span class="text-black font-medium">Alamat Sekolah:</span> 
                        <p class="text-gray-700">${requestData.address}</p>
                    </div>

                    <div class="col-span-2">
                        <span class="text-black font-medium">Jumlah Siswa:</span> 
                        <p class="text-gray-700">${requestData.student_count}</p>
                    </div>
                </li>
                <li class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <span class="text-black font-medium">Catatan Tambahan:</span> 
                        <p class="text-gray-700">${requestData.additional_notes}</p>
                    </div>
                </li>
            `;
        }


        document.querySelectorAll(".food-request").forEach(item => {
            item.addEventListener("click", function (event) {
                if (event.target.closest(".approve-btn") || event.target.closest(".reject-btn")) {
                    return;
                }

                const requestData = {
                    school_name: this.querySelector("li:nth-child(1)").innerText.split(": ")[1],
                    address: this.querySelector("li:nth-child(2)").innerText.split(": ")[1],
                    contact_person: this.querySelector("li:nth-child(3)").innerText.split(": ")[1],
                    student_count: this.querySelector("li:nth-child(4)").innerText.split(": ")[1],
                    additional_notes: this.querySelector("li:nth-child(5)") ? this.querySelector("li:nth-child(5)").innerText.split(": ")[1] : "Tidak ada catatan tambahan"
                };
                openModal(requestData);
            });
        });

        closeModalBtn.addEventListener("click", function () {
            modal.classList.add("hidden"); 
        });

        modal.addEventListener("click", function (event) {
            if (!event.target.closest(".modal-content")) {
                modal.classList.add("hidden");
            }
        });
        
    });
</script>

<body>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
       
        <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-500 text-white shadow-lg relative z-10">
           
            <div class="p-6 flex items-center space-x-3 border-b border-green-400 border-opacity-30">
                <div class="rounded-full p-2 bg-white bg-opacity-20 shadow-md">
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
                <h1 class="text-xl font-bold tracking-wide">FoodShare Hub</h1>
            </div>

           
            <nav class="mt-8 px-4">
                <div class="mb-6">
                    <p class="text-xs text-green-200 font-semibold uppercase tracking-wider mb-2 ml-4">Main Menu</p>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-home mr-3 w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.food-requests') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-hand-holding-heart mr-3 w-5 text-center"></i>
                        <span>Lihat Permintaan</span>
                    </a>
                    
                    <a href="#" class="sidebar-link active flex items-center px-4 py-3 mb-2 bg-green-700 bg-opacity-50 rounded-lg font-medium">
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
                <div class="flex items-center space-x-3 bg-green-700 bg-opacity-30 p-3 rounded-lg hover:bg-opacity-40 transition-all">
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
                <h1 class="text-2xl font-bold text-gray-800">History</h1>
                <div class="flex items-center space-x-4">
                    <button class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors relative">
                        <i class="fas fa-bell text-gray-600"></i>
                    </button>
                    <div class="relative">
                        
                        <button class="p-2 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                            <i class="fas fa-envelope text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </header>


           <div class="flex flex-row mt-10 px-10 justify-between">
                <a href="{{ route('admin.see.history') }}" 
                class="filter-btn inline-flex justify-center items-center text-md font-semibold rounded-xl bg-gray-200 text-gray-800 min-h-[43px] w-[265px] px-4 shadow-lg hover:bg-gray-300 transition-colors">
                    <i class="fas fa-list-ul mr-2"></i>
                    Show All History
                </a>


                <a href="{{ route('admin.see.history', ['status' => 'pending']) }}" class="filter-btn inline-flex justify-center items-center text-md font-semibold rounded-xl bg-yellow-100 text-yellow-800 min-h-[43px] w-[265px] px-4 shadow-lg hover:bg-yellow-200 transition-colors">
                    <i class="fas fa-clock mr-2"></i>
                    Pending
                </a>

                <a href="{{ route('admin.see.history', ['status' => 'approved']) }}" class="filter-btn inline-flex justify-center items-center text-md font-semibold rounded-xl bg-green-100 text-green-800 min-h-[43px] w-[265px] px-4 shadow-lg hover:bg-green-200 transition-colors">
                    <i class="fas fa-check-circle mr-2"></i>
                    Approved
                </a>

                <a href="{{ route('admin.see.history', ['status' => 'rejected']) }}" class="filter-btn inline-flex justify-center items-center text-md font-semibold rounded-xl bg-red-100 text-red-800 min-h-[43px] w-[265px] px-4 shadow-lg hover:bg-red-200 transition-colors">
                    <i class="fas fa-times-circle mr-2"></i>
                    Rejected
                </a>
           </div>
            
           @if ($foodRequests->isEmpty())
                <div class="flex justify-center mt-16">
                    <div class="text-center">
                        <i class="fas fa-inbox text-5xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500 text-lg">Tidak ada permintaan makanan.</p>
                    </div>
                </div>
            @else
                <div class="flex flex-wrap p-6">
                    @foreach($foodRequests->sortBy('id') as $index => $requests)
                        <div class="food-request stat-card flex shadow-md bg-white p-6 mt-6 mx-4 rounded-lg min-w-[600px] h-auto cursor-pointer relative
                                    status-{{ $requests->status ?? 'pending' }}">
                            <div class="status-badge badge-{{ $requests->status ?? 'pending' }}">
                                @if(($requests->status ?? 'pending') == 'pending')
                                    <i class="fas fa-clock"></i> Pending
                                @elseif(($requests->status ?? '') == 'approved')
                                    <i class="fas fa-check-circle"></i> Approved
                                @elseif(($requests->status ?? '') == 'rejected')
                                    <i class="fas fa-times-circle"></i> Rejected
                                @endif
                            </div>
                            <div class="flex flex-col justify-between w-full">
                                <div class="flex font-medium text-lg mb-3">
                                    <p class="mr-2">
                                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                                    </p>
                                    <p>Permintaan</p>
                                    <p class="ml-2 px-2 bg-blue-100 text-blue-800 rounded-md">{{ $requests->id }}</p>
                                </div>
                                <ul class="list-none text-green-500">
                                    <li class="mb-2 p-2 hover:bg-gray-50 rounded transition-colors">
                                        <span class="text-black font-medium mr-4">
                                            <i class="fas fa-school text-blue-500 mr-2"></i>Nama Sekolah:
                                        </span> 
                                        {{ $requests->school_name }}
                                    </li>
                                    <li class="mb-2 p-2 hover:bg-gray-50 rounded transition-colors">
                                        <span class="text-black font-medium mr-2">
                                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>Alamat Sekolah:
                                        </span> 
                                        {{ $requests->address }}
                                    </li>
                                    <li class="mb-2 p-2 hover:bg-gray-50 rounded transition-colors">
                                        <span class="text-black font-medium mr-2">
                                            <i class="fas fa-user text-purple-500 mr-2"></i>Contact Person:
                                        </span> 
                                        {{ $requests->contact_person }}
                                    </li>
                                    <li class="mb-2 p-2 hover:bg-gray-50 rounded transition-colors">
                                        <span class="text-black font-medium mr-5">
                                            <i class="fas fa-users text-green-500 mr-2"></i>Jumlah Siswa:
                                        </span> 
                                        {{ $requests->student_count }}
                                    </li>
                                </ul>
                                <div class="flex justify-end mt-4">
                                    <button class="text-blue-500 hover:text-blue-700 transition-colors flex items-center">
                                        <i class="fas fa-eye mr-1"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div id="foodRequestModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="modal-content bg-white p-6 rounded-lg shadow-lg w-1/2">
                        <div class="flex justify-between items-center border-b pb-3">
                            <h2 class="text-xl font-bold flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                Detail Permintaan Makanan
                            </h2>
                            <button id="closeModal" class="text-gray-500 hover:text-red-500 hover:bg-red-50 rounded-full h-8 w-8 flex items-center justify-center transition-colors">&times;</button>
                        </div>
                        <ul class="grid grid-cols-2 gap-4 mt-4">
                    
                        </ul>
                    </div>
                </div>
            @endif
        
        </div>
    </div>
</body>
</html>