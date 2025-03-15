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
        const confirmationModal = document.getElementById("confirmationModal");
        const rejectionReasonModal = document.getElementById("rejectionReasonModal");
        const closeModalBtn = document.getElementById("closeModal");
        const closeConfirmBtn = document.getElementById("closeConfirmation");
        const closeRejectionBtn = document.getElementById("closeRejection");
        let currentRequestId = null;
        let currentAction = null;

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

        function openConfirmationModal(id, action) {
            currentRequestId = id;
            currentAction = action;
            
            const actionText = action === 'approve' ? 'menyetujui' : 'menolak';
            const schoolName = document.querySelector(`[data-id="${id}"]`).closest('.food-request').querySelector('[data-field="nama_sekolah"]').innerText.split(':')[1].trim();
            
            document.getElementById("confirmationText").innerText = `Apakah Anda yakin ingin ${actionText} permintaan dari ${schoolName}?`;
            
            confirmationModal.classList.remove("hidden");
        }

        function openRejectionReasonModal(id) {
            currentRequestId = id;
            const schoolName = document.querySelector(`[data-id="${id}"]`).closest('.food-request').querySelector('[data-field="nama_sekolah"]').innerText.split(':')[1].trim();
            
            document.getElementById("rejectionSchoolName").innerText = schoolName;
            rejectionReasonModal.classList.remove("hidden");
        }

        document.querySelectorAll(".food-request").forEach(item => {
            item.addEventListener("click", function (event) {
                if (event.target.closest(".approve-btn") || event.target.closest(".reject-btn")) {
                    return;
                }

                const requestData = {
                    school_name: this.querySelector('[data-field="nama_sekolah"]').innerText.split(':')[1].trim(),
                    address: this.querySelector('[data-field="alamat"]').innerText.split(':')[1].trim(),
                    contact_person: this.querySelector('[data-field="kontak"]').innerText.split(':')[1].trim(),
                    student_count: this.querySelector('[data-field="jumlah_siswa"]').innerText.split(':')[1].trim(),
                    additional_notes: this.querySelector('[data-field="catatan"]')?.innerText.split(':')[1].trim() || "Tidak ada catatan tambahan"
                };
                openModal(requestData);
            });
        });

        closeModalBtn.addEventListener("click", function () {
            modal.classList.add("hidden"); 
        });

        closeConfirmBtn.addEventListener("click", function () {
            confirmationModal.classList.add("hidden"); 
        });

        closeRejectionBtn.addEventListener("click", function () {
            rejectionReasonModal.classList.add("hidden"); 
        });

        document.getElementById("cancelButton").addEventListener("click", function () {
            confirmationModal.classList.add("hidden");
        });

        document.getElementById("confirmButton").addEventListener("click", async function () {
            if (currentRequestId && currentAction) {
                if (currentAction === 'approve') {
                    const form = document.getElementById(`approve-form-${currentRequestId}`);
                    if (form) {
                        form.submit();
                    }
                    confirmationModal.classList.add("hidden");
                } else if (currentAction === 'reject') {
                    confirmationModal.classList.add("hidden");
                    openRejectionReasonModal(currentRequestId);
                }
            }
        });

        document.getElementById("submitRejectionButton").addEventListener("click", function() {
            const rejectionReason = document.getElementById("rejectionReason").value.trim();
            
            if (rejectionReason === "") {
                document.getElementById("rejectionError").classList.remove("hidden");
                return;
            }
            
            const form = document.getElementById(`reject-form-${currentRequestId}`);
            if (form) {
                const reasonInput = document.createElement("input");
                reasonInput.type = "hidden";
                reasonInput.name = "rejection_reason";
                reasonInput.value = rejectionReason;
                form.appendChild(reasonInput);
                
                form.submit();
            }
            
            rejectionReasonModal.classList.add("hidden");
        });

        document.getElementById("cancelRejectionButton").addEventListener("click", function() {
            rejectionReasonModal.classList.add("hidden");
        });

        modal.addEventListener("click", function (event) {
            if (!event.target.closest(".modal-content")) {
                modal.classList.add("hidden");
            }
        });

        confirmationModal.addEventListener("click", function (event) {
            if (!event.target.closest(".modal-content")) {
                confirmationModal.classList.add("hidden");
            }
        });

        rejectionReasonModal.addEventListener("click", function (event) {
            if (!event.target.closest(".modal-content")) {
                rejectionReasonModal.classList.add("hidden");
            }
        });

        document.querySelectorAll(".approve-btn").forEach(button => {
            button.addEventListener("click", function (event) {
                event.stopPropagation();
                let requestId = this.getAttribute("data-id");
                openConfirmationModal(requestId, 'approve');
            });
        });

        document.querySelectorAll(".reject-btn").forEach(button => {
            button.addEventListener("click", function (event) {
                event.stopPropagation();
                let requestId = this.getAttribute("data-id");
                openConfirmationModal(requestId, 'reject');
            });
        });
    });
</script>


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
                <p class="flex justify-center mt-6 text-gray-500">Tidak ada permintaan makanan.</p>
            @else
                @foreach ($foodRequests as $requests)
                  @if($requests->status == 'pending')
                    <div class="food-request stat-card flex shadow-md bg-white p-6 mt-6 ml-[33px] mr-[32px] rounded-xs w-auto h-auto cursor-pointer">
                        <div class="flex flex-row justify-between w-full">
                                <div>
                                    @if($requests->status == 'pending')
                                        <div class="inline-flex justify-center items-center text-xs font-semibold rounded-xl bg-yellow-100 text-yellow-800 min-h-[33px] w-auto px-4 mb-4">{{ ucfirst($requests->status) }}</div>
                                    @endif

                                    @if($requests->status == 'pending')
                                    <ul class="list-none text-green-500">
                                        <li data-field="nama_sekolah">
                                            <span class="text-black font-medium mr-4">Nama Sekolah:</span> {{ $requests->school_name }}
                                        </li>
                                        <li data-field="alamat">
                                            <span class="text-black font-medium mr-2">Alamat Sekolah:</span> {{ $requests->address }}
                                        </li>
                                        <li data-field="kontak">
                                            <span class="text-black font-medium mr-2">Contact Person:</span> {{ $requests->contact_person }}
                                        </li>
                                        <li data-field="jumlah_siswa">
                                            <span class="text-black font-medium mr-5">Jumlah Siswa:</span> {{ $requests->student_count }}
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            
                                    @if ($requests->status == 'pending')
                                    <div class="flex flex-row justify-between space-x-2 items-end">
                                            <form id="approve-form-{{ $requests->id }}" action="{{ route('food-requests.approve', $requests->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" data-id="{{ $requests->id }}" class="approve-btn inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-green-100 text-green-800 h-[33px] w-[165px] hover:bg-opacity-70 transition-colors">
                                                    Setuju
                                                </button>
                                            </form>

                                            <form id="reject-form-{{ $requests->id }}" action="{{ route('food-requests.reject', $requests->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" data-id="{{ $requests->id }}" class="reject-btn inline-flex justify-center items-center text-xs font-semibold rounded-3xl bg-red-100 text-red-800 h-[33px] w-[165px] hover:bg-opacity-70 transition-colors">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                            </div>
                        </div>
                    @endif
                @endforeach


                <div id="foodRequestModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="modal-content bg-white p-6 rounded-lg shadow-lg w-1/2">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold">Detail Permintaan Makanan</h2>
                            <button id="closeModal" class="text-red-500 font-bold text-xl">&times;</button>
                        </div>
                        <ul class="grid grid-cols-2 gap-4 mt-4">
                           
                        </ul>
                    </div>
                </div>
            </div>

            
                <div id="confirmationModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="modal-content bg-white p-6 rounded-lg shadow-lg w-96">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold">Konfirmasi</h2>
                            <button id="closeConfirmation" class="text-red-500 font-bold text-xl">&times;</button>
                        </div>
                        <div class="my-6">
                            <p id="confirmationText" class="text-gray-700">Apakah Anda yakin ingin melakukan tindakan ini?</p>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button id="cancelButton" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">
                                Batal
                            </button>
                            <button id="confirmButton" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                                Ya, Lanjutkan
                            </button>
                        </div>
                    </div>
                </div>

                <div id="rejectionReasonModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
                    <div class="modal-content bg-white p-6 rounded-lg shadow-lg w-96">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold">Alasan Penolakan</h2>
                            <button id="closeRejection" class="text-red-500 font-bold text-xl">&times;</button>
                        </div>
                        <div class="my-6">
                            <p class="text-gray-700 mb-2">Permintaan dari <span id="rejectionSchoolName" class="font-medium"></span> akan ditolak.</p>
                            <p class="text-gray-700 mb-4">Mohon berikan alasan penolakan:</p>
                            <textarea id="rejectionReason" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Masukkan alasan penolakan..."></textarea>
                            <p id="rejectionError" class="text-red-500 mt-2 hidden">Alasan penolakan tidak boleh kosong.</p>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button id="cancelRejectionButton" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition-colors">
                                Batal
                            </button>
                            <button id="submitRejectionButton" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                Tolak Permintaan
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>