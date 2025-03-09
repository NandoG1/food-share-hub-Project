<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FoodShare Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
   
        <div class="hidden md:block w-1/2 bg-cover bg-center" style="background-image: url('Images/Register.avif')">
        </div>
        
        <div class="w-full md:w-1/2 flex items-center justify-center p-8 bg-white bg-opacity-90">
            <div class="w-full max-w-md">
                <div class="flex justify-center mb-6">
                   <img src="Images/svgviewer-output.svg" alt="" width="60px">
                </div>
                
                <div class="text-center mb-8">
                    <p class="text-gray-600 mb-1">Welcome to FoodShare Hub!</p>
                    <h1 class="text-3xl font-bold text-gray-800 mb-1">Create your Account</h1>
                    <p class="text-gray-500">
                        Already have account? <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-medium">Sign in</a>
                    </p>
                </div>
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="backdrop-blur-sm bg-white bg-opacity-60 rounded-lg border border-gray-100 shadow-lg p-8">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Your name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <img src="Images/svgviewer-output5.svg" alt="" width="20px">
                            </div>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                class="pl-10 w-full px-4 py-3 bg-white bg-opacity-80 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Your email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <img src="Images/svgviewer-output1.svg" alt="" width="20px">
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                class="pl-10 w-full px-4 py-3 bg-white bg-opacity-80 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <img src="Images/svgviewer-output2.svg" alt="" width="20px">
                            </div>
                            <input id="password" name="password" type="password" required
                                class="pl-10 w-full px-4 py-3 bg-white bg-opacity-80 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <img src="Images/svgviewer-output2.svg" alt="" width="20px">
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="pl-10 w-full px-4 py-3 bg-white bg-opacity-80 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        </div>
                    </div>
                    
                    
                    
                    <button type="submit" 
                        class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-md">
                        Register Now
                    </button>
                </form>
                
                <div class="mt-8 flex items-center justify-center space-x-6 text-gray-500 text-sm">
                    <div class="flex items-center">
                        <img src="Images/svgviewer-output3.svg" alt="" width="20px" class="pr-1">
                        Secure
                    </div>
                    <div class="flex items-center">
                        <img src="Images/svgviewer-output4.svg" alt="" width="20px" class="pr-1">
                        Private
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>