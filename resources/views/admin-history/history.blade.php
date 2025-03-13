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
                        <p>${requestData.school_name}</p>
                    </div>
                    <div class="col-span-2">
                        <span class="text-black font-medium">Contact Person:</span> 
                        <p>${requestData.contact_person}</p>
                    </div>
                </li>
                <li class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <span class="text-black font-medium">Alamat Sekolah:</span> 
                        <p>${requestData.address}</p>
                    </div>

                    <div class="col-span-2">
                        <span class="text-black font-medium">Jumlah Siswa:</span> 
                        <p>${requestData.student_count}</p>
                    </div>
                </li>
                <li class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <span class="text-black font-medium">Catatan Tambahan:</span> 
                        <p>${requestData.additional_notes}</p>
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
                <h1 class="text-2xl font-bold text-gray-800">History</h1>
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


           <div class="flex flex-row mt-10">
                <a href="{{ route('admin.see.history') }}" 
                class="inline-flex justify-center items-center text-md font-semibold rounded-xl bg-gray-200 text-yellow-800 min-h-[43px] w-[265px] px-4 m-10 shadow-lg hover:bg-opacity-50 transition-colors">
                    Show All History
                </a>


                <a href="{{ route('admin.see.history', ['status' => 'pending']) }}" class="inline-flex justify-center items-center text-md font-semibold rounded-xl bg-yellow-100 text-yellow-800 min-h-[43px] w-[265px] px-4 m-10 shadow-lg hover:bg-opacity-50 transition-colors">
                    Pending
                </a href="">

                <a href="{{ route('admin.see.history', ['status' => 'approved']) }}" class="inline-flex justify-center items-center text-md font-semibold rounded-xl bg-green-100 text-yellow-800 min-h-[33px] w-[265px] px-4 m-10 shadow-lg hover:bg-opacity-50 transition-colors">
                    Approved
                </a href="">

                <a href="{{ route('admin.see.history', ['status' => 'rejected']) }}" class="inline-flex justify-center items-center text-md font-semibold rounded-xl bg-red-100 text-yellow-800 min-h-[33px] w-[265px] px-4 m-10 shadow-lg hover:bg-opacity-50 transition-colors">
                    Rejected
                </a href="">
           </div>
            
           @if ($foodRequests->isEmpty())
                <p class="text-gray-500">Tidak ada permintaan makanan.</p>
            @else
            <div class="flex flex-wrap">
                @foreach($foodRequests->sortBy('id') as $index => $requests)
                    <div class="food-request flex shadow-md bg-white p-6 mt-6 ml-[35px] mr-[35px] rounded-xs min-w-[600px] h-auto cursor-pointer hover:shadow-lg rounded-lg transition-shadow 
                                {{ $loop->iteration % 4 < 2 ? 'flex-row' : 'flex-col' }}">
                        <div class="flex flex-col justify-between w-full">
                            <div class="flex font-medium text-lg">
                                <p class="mr-2">Permintaan</p>
                                <p>{{ $requests->id }}</p>
                            </div>
                            <ul class="list-none text-green-500">
                                <li><span class="text-black font-medium mr-4">Nama Sekolah:</span> {{ $requests->school_name }}</li>
                                <li><span class="text-black font-medium mr-2">Alamat Sekolah:</span> {{ $requests->address }}</li>
                                <li><span class="text-black font-medium mr-2">Contact Person:</span> {{ $requests->contact_person }}</li>
                                <li><span class="text-black font-medium mr-5">Jumlah Siswa:</span> {{ $requests->student_count }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>


            <div id="foodRequestModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold">Detail Permintaan Makanan</h2>
                            <button id="closeModal" class="text-red-500 font-bold text-xl">&times;</button>
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