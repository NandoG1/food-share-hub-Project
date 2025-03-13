<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Requests - FoodShare Hub</title>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("foodRequestModal");
        const closeModalBtn = document.getElementById("closeModal");

        function openModal(requestData) {
            modal.classList.remove("hidden");

            modal.querySelector("ul").innerHTML = `
                <li><span class="text-black font-medium mr-4">Nama Sekolah</span> <br> ${requestData.school_name}</li>
                <li><span class="text-black font-medium mr-2">Alamat Sekolah</span> <br> ${requestData.address}</li>
                <li><span class="text-black font-medium mr-2">Contact Person</span> <br> ${requestData.contact_person}</li>
                <li><span class="text-black font-medium mr-5">Jumlah Siswa</span> <br> ${requestData.student_count}</li>
                <li><span class="text-black font-medium">Catatan Tambahan</span> <br> ${requestData.additional_notes}</li>
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

        document.querySelectorAll(".approve-btn").forEach(button => {
            button.addEventListener("click", function (event) {
                event.stopPropagation(); 
                let requestId = this.getAttribute("data-id");

                fetch(`/food-requests/${requestId}/approve`, {
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            });
        });

        document.querySelectorAll(".reject-btn").forEach(button => {
            button.addEventListener("click", function (event) {
                event.stopPropagation();
                let requestId = this.getAttribute("data-id");

                fetch(`/food-requests/${requestId}/reject`, {
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            });
        });
    });
</script>


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
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-home mr-3 w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="sidebar-link active flex items-center px-4 py-3 mb-2 bg-green-700 bg-opacity-50 rounded-lg font-medium">
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
                    <a href="#" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
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
                <h1 class="text-2xl font-bold text-gray-800">Lihat Permintaan</h1>
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


            @if ($foodRequests->isEmpty())
                <p class="text-gray-500">Tidak ada permintaan makanan.</p>
            @else
                @foreach ($foodRequests as $requests)
                <div class="food-request stat-card flex shadow-md bg-white p-6 mt-6 ml-[33px] mr-[32px] rounded-xs w-auto h-auto cursor-pointer">
                    <div class="flex flex-row justify-between w-full">
                            <div>
                                <div class="inline-flex justify-center items-center text-xs font-semibold rounded-xl bg-yellow-100 text-yellow-800 min-h-[33px] w-auto px-4 mb-4">{{ $requests->status }}</div>

                                <ul class="list-none text-green-500">
                                    <li>
                                        <span class="text-black font-medium mr-4">Nama Sekolah:</span> {{ $requests->school_name }}
                                    </li>
                                    <li>
                                        <span class="text-black font-medium mr-2">Alamat Sekolah:</span> {{ $requests->address }}
                                    </li>
                                    <li>
                                        <span class="text-black font-medium mr-2">Contact Person:</span> {{ $requests->contact_person }}
                                    </li>
                                    <li>
                                        <span class="text-black font-medium mr-5">Jumlah Siswa:</span> {{ $requests->student_count }}
                                    </li>
                                </ul>
                            </div>
                          
                                @if ($requests->status == 'pending')
                                    <div class="flex flex-row justify-between space-x-2 items-end">
                                        <form action="{{ route('food-requests.approve', $requests->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" data-id="{{ $requests->id }}" class="approve-btn inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-green-100 text-green-800 h-[33px] w-[165px] hover:bg-opacity-70 transition-colors">
                                                Setuju
                                            </button>
                                        </form>

                                        <form action="{{ route('food-requests.reject', $requests->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" data-id="{{ $requests->id }}" class="rejected-btn inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-red-100 text-red-800 h-[33px] w-[165px] hover:bg-opacity-70 transition-colors">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>

                                @elseif ($requests->status == 'approved')
                                    <div class="flex flex-row justify-between space-x-2 items-end">
                                        <div class="inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-gray-100 text-gray-800 h-[33px] w-[165px]">
                                        Setuju
                                        </div>

                                        <form action="{{ route('food-requests.reject', $requests->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" data-id="{{ $requests->id }}" class="rejected-btn inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-red-100 text-red-800 h-[33px] w-[165px] hover:bg-opacity-70 transition-colors">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>

                                @elseif ($requests->status == 'rejected')
                                    <div class="flex flex-row justify-between space-x-2 items-end">
                                    <form action="{{ route('food-requests.approve', $requests->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" data-id="{{ $requests->id }}"class="approve-btn inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-green-100 text-green-800 h-[33px] w-[165px] hover:bg-opacity-70 transition-colors">
                                                Setuju
                                            </button>
                                        </form>

                                        <div class="inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-gray-100 text-gray-800 h-[33px] w-[165px]">
                                        Tolak
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                @endforeach


                <div id="foodRequestModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold">Detail Permintaan Makanan</h2>
                            <button id="closeModal" class="text-red-500 font-bold text-xl">&times;</button>
                        </div>
                        <ul class="mt-4 space-y-2">

                        </ul>
                    </div>
                </div>

            @endif
        
        </div>
    </div>
</body>
</html>
