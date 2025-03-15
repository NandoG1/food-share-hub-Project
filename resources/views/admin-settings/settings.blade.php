<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings - FoodShare Hub</title>
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

        textarea::placeholder{
            font-size: 14px;
            font-weight: 400;
            color: #A5A5A5;
        }
    </style>
</head>
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
                    <a href="#" class="sidebar-link active flex items-center px-4 py-3 mb-2 bg-green-700 bg-opacity-50 rounded-lg font-medium">
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
                <h1 class="text-2xl font-bold text-gray-800">Admin Settings</h1>
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
                <div class="flex flex-row space-x-2 ">
                    <div class="bg-white shadow-lg rounded-lg p-6 w-full">
                        <form action="{{ route('admin.update.profile.photo', ['id' => Auth::guard('admin')->user()->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-row">
                                <img class="ml-[34px] w-32 h-32 rounded-full text-center justify-center" 
                                    src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('Images/profile-picture.png') }}" 
                                    alt="Foto Profil Admin">

                                <div class="p-6">
                                    <label class="bg-white flex justify-center items-center rounded-md shadow-lg font-bold h-[47px] w-[194px] text-center mb-4 hover:opacity-50 transition-opacity cursor-pointer">
                                        Upload New Photo
                                        <input type="file" name="admin_photo" class="hidden" onchange="this.form.submit()">
                                    </label>

                                    <div class="flex flex-col">
                                        <p class="text-gray-500">At least 800x800 px recommended.</p>
                                        <p class="text-gray-500">JPG or PNG is allowed</p>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div class="bg-white shadow-lg w-full mt-6 p-6 rounded-lg">
                            <div class="flex flex-row justify-between mb-6">
                                <p class="text-lg font-bold mb-10">Personal Info</p>
                                <div class="flex justify-center rounded-2xl shadow-lg w-[74px] h-[32px] font-bold mt-2 hover:opacity-50 transition-opacity cursor-pointer">
                                    <a href="{{ route('admin.settings.detail') }}">Edit</a>
                                </div>
                            </div>

                            <div class="flex flex-row justify-between space-x-4 w-full">
                                <div>
                                    <p class="text-gray-500">Full Name</p>
                                    <p class="font-bold">{{ Auth::user()->name }}</p>
                                </div>

                                <div>
                                    <p class="text-gray-500">Email</p>
                                    <p class="font-bold">{{ Auth::user()->email }}</p>
                                </div>

                                <div>
                                    <p class="text-gray-500">Phone Number</p>
                                    <p class="font-bold">{{ Auth::user()->phone ?? 'Belum ada nomor telepon' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-lg w-full mt-10 rounded-lg">
                            <div class="flex flex-row justify-between p-6">
                                <div class="flex flex-col">
                                    <p class="text-gray-500">Jumlah Penerimaan Permintaan</p>
                                    <p class="font-bold">{{ (Auth::user()->approved) }} Permintaan</p>
                                </div>

                                <div >
                                    <p class="text-gray-500">Jumlah Penerimaan Permintaan</p>
                                    <p class="font-bold">{{ (Auth::user()->rejected) }} Permintaan</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-xl w-full mt-6 p-6 rounded-lg">
                            <p class="text-lg font-bold mb-6">Bio</p>

                            <form action="{{ route('admin.update.profile.bio') }}" method="POST" class="mb-6">
                                @csrf
                                <textarea name="bio" id="bio" placeholder="Tuliskan sesuatu disini" class="w-full h-32 rounded-lg border-2 bg-gray-100 p-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">{{ trim(old('bio', Auth::user()->bio)) }} </textarea>

                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-md">
                                    <i class="fas fa-save mr-2"></i> Save Changes
                                    </button>
                                </div>
                            </form>

                        </div>

                        


                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 w-[288px] h-[356px]">
                        <p class="text-center text-lg font-bold">Complete your profile</p>

                        <canvas id="profileCompletionChart" width="200" height="200">{{ $profileCompletion }}%</canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('profileCompletionChart').getContext('2d');
    const profileCompletion = {{ $profileCompletion }}; 

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [profileCompletion, 100 - profileCompletion],
                backgroundColor: ['#16A34A', '#D1D5DB'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                tooltip: {
                    enabled: false
                }
            }
        },
        plugins: [{
            beforeDraw: function(chart) {
                let width = chart.width,
                    height = chart.height,
                    ctx = chart.ctx;

                ctx.restore();
                let fontSize = (height / 6).toFixed(2);
                ctx.font = "bold " + fontSize + "px system-ui";
                ctx.textBaseline = "middle";

                let text = profileCompletion + "%",
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;

                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }]
    });

</script>