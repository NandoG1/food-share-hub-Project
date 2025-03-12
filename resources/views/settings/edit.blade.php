<!-- resources/views/settings/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - FoodShare Hub</title>
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
        .form-input:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2);
        }
        /* Added styles for form fields */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2);
            outline: none;
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
                    <a href="{{ route('aid-history.index') }}" class="sidebar-link flex items-center px-4 py-3 mb-2 hover:bg-green-700 hover:bg-opacity-50 rounded-lg transition-colors">
                        <i class="fas fa-history mr-3 w-5 text-center"></i>
                        <span>Riwayat Bantuan</span>
                    </a>
                </div>
                
                <div class="mb-6">
                    <p class="text-xs text-green-200 font-semibold uppercase tracking-wider mb-2 ml-4">Settings</p>
                    <a href="{{ route('settings.edit') }}" class="sidebar-link active flex items-center px-4 py-3 mb-2 bg-green-700 bg-opacity-50 rounded-lg text-white font-medium">
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
                <h1 class="text-2xl font-bold text-gray-800">Informasi Akun Sekolah</h1>
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
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow">
                        <div class="flex items-center">
                            <div class="py-1">
                                <i class="fas fa-check-circle mr-2"></i>
                            </div>
                            <div>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="border-b pb-4 mb-8">
                        <h2 class="text-xl font-semibold text-gray-800">Informasi Sekolah</h2>
                        <p class="text-sm text-gray-500 mt-1">Isi informasi dibawah ini dengan benar sebagai bagian dari penanggungjawaban ajuan.</p>
                    </div>

                    <form action="{{ route('settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                           
                            <div class="form-group">
                                <label for="school_name" class="form-label text-sm font-medium text-gray-700">School Name <span class="text-red-500">*</span></label>
                                <input type="text" name="school_name" id="school_name" value="{{ old('school_name', $schoolSetting->school_name ?? '') }}" 
                                    class="form-control px-4 py-3 @error('school_name') border-red-500 @enderror" 
                                    required>
                                @error('school_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                           
                            <div class="form-group">
                                <label for="school_level" class="form-label text-sm font-medium text-gray-700">School Level</label>
                                <select name="school_level" id="school_level" 
                                    class="form-control px-4 py-3">
                                    <option value="">-- Select School Level --</option>
                                    <option value="SD" {{ (old('school_level', $schoolSetting->school_level ?? '') == 'SD') ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ (old('school_level', $schoolSetting->school_level ?? '') == 'SMP') ? 'selected' : '' }}>SMP</option>
                                    <option value="SMAA" {{ (old('school_level', $schoolSetting->school_level ?? '') == 'SMA') ? 'selected' : '' }}>SMA</option>
                                    <option value="SMK" {{ (old('school_level', $schoolSetting->school_level ?? '') == 'SMK') ? 'selected' : '' }}>SMK</option>
                                    <option value="Lain-Lain" {{ (old('school_level', $schoolSetting->school_level ?? '') == 'Lain-Lain') ? 'selected' : '' }}>Lain-Lain</option>
                                </select>
                            </div>

                            
                            <div class="md:col-span-2 form-group">
                                <label for="school_address" class="form-label text-sm font-medium text-gray-700">School Address <span class="text-red-500">*</span></label>
                                <textarea name="school_address" id="school_address" rows="3" 
                                    class="form-control px-4 py-3 @error('school_address') border-red-500 @enderror" 
                                    required>{{ old('school_address', $schoolSetting->school_address ?? '') }}</textarea>
                                @error('school_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                           
                            <div class="form-group">
                                <label for="city" class="form-label text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city" value="{{ old('city', $schoolSetting->city ?? '') }}" 
                                    class="form-control px-4 py-3">
                            </div>

                            
                            <div class="form-group">
                                <label for="postal_code" class="form-label text-sm font-medium text-gray-700">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $schoolSetting->postal_code ?? '') }}" 
                                    class="form-control px-4 py-3">
                            </div>
                        </div>

                        <div class="border-t border-b py-6 my-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-6">Contact Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                
                                <div class="form-group">
                                    <label for="principal_name" class="form-label text-sm font-medium text-gray-700">Principal Name</label>
                                    <input type="text" name="principal_name" id="principal_name" value="{{ old('principal_name', $schoolSetting->principal_name ?? '') }}" 
                                        class="form-control px-4 py-3">
                                </div>

                                
                                <div class="form-group">
                                    <label for="program_coordinator" class="form-label text-sm font-medium text-gray-700">Program Coordinator</label>
                                    <input type="text" name="program_coordinator" id="program_coordinator" value="{{ old('program_coordinator', $schoolSetting->program_coordinator ?? '') }}" 
                                        class="form-control px-4 py-3">
                                </div>

                              
                                <div class="form-group">
                                    <label for="school_phone" class="form-label text-sm font-medium text-gray-700">School Phone</label>
                                    <input type="text" name="school_phone" id="school_phone" value="{{ old('school_phone', $schoolSetting->school_phone ?? '') }}" 
                                        class="form-control px-4 py-3">
                                    @error('school_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                
                                <div class="form-group">
                                    <label for="coordinator_phone" class="form-label text-sm font-medium text-gray-700">Coordinator Phone</label>
                                    <input type="text" name="coordinator_phone" id="coordinator_phone" value="{{ old('coordinator_phone', $schoolSetting->coordinator_phone ?? '') }}" 
                                        class="form-control px-4 py-3">
                                    @error('coordinator_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                               
                                <div class="form-group">
                                    <label for="school_email" class="form-label text-sm font-medium text-gray-700">School Email</label>
                                    <input type="email" name="school_email" id="school_email" value="{{ old('school_email', $schoolSetting->school_email ?? '') }}" 
                                        class="form-control px-4 py-3">
                                    @error('school_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                
                                <div class="form-group">
                                    <label for="coordinator_email" class="form-label text-sm font-medium text-gray-700">Coordinator Email</label>
                                    <input type="email" name="coordinator_email" id="coordinator_email" value="{{ old('coordinator_email', $schoolSetting->coordinator_email ?? '') }}" 
                                        class="form-control px-4 py-3">
                                    @error('coordinator_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 pt-4">
                            <button type="reset" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                                Reset
                            </button>
                            <button type="submit" class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-md">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>