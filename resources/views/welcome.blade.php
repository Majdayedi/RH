<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- User Card -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">Welcome back, {{ Auth::user()->first_name }}!</h1>
                        <p class="opacity-90">Here's your profile information</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name) }}&background=random" 
                         alt="Profile" 
                         class="w-16 h-16 rounded-full border-2 border-white">
                </div>
            </div>
            
            <!-- User Details -->
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Personal Info -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">
                            <i class="fas fa-user mr-2"></i> Personal Information
                        </h2>
                        <div class="flex items-center">
                            <i class="fas fa-id-card text-gray-500 w-6"></i>
                            <div class="ml-3">
                                <p class="text-sm text-gray-500">Matricule</p>
                                <p class="font-medium">{{ Auth::user()->matricule }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-gray-500 w-6"></i>
                            <div class="ml-3">
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Work Info -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">
                            <i class="fas fa-briefcase mr-2"></i> Work Information
                        </h2>
                        <div class="flex items-center">
                            <i class="fas fa-building text-gray-500 w-6"></i>
                            <div class="ml-3">
                                <p class="text-sm text-gray-500">Department</p>
                                <p class="font-medium">{{ Auth::user()->department }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-tag text-gray-500 w-6"></i>
                            <div class="ml-3">
                                <p class="text-sm text-gray-500">Role</p>
                                <p class="font-medium capitalize">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t flex flex-wrap gap-4">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>