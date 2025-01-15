<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skybeacon</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
</head>
<body class="min-h-screen bg-gradient-to-b from-blue-500 to-white font-[Poppins]">
    <x-guest-layout>
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between h-20">
                <div class="flex items-center">
                    <span class="ml-3 text-2xl font-semibold text-blue-600">Skybeacon</span>
                </div>
            </nav>
        </div>

        <main class="flex items-center justify-center min-h-[calc(100vh-5rem)] px-4">
            <div class="w-full max-w-md bg-white/80 backdrop-blur-sm rounded-lg shadow-lg p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-blue-600 mb-2">Login</h1>
                    <p class="text-gray-600">Please enter your credentials</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="email" 
                               name="email" 
                               :value="old('email')"
                               placeholder="Email or Username" 
                               class="!rounded-button w-full pl-10 pr-4 py-3 border border-blue-300 focus:border-blue-600 focus:ring focus:ring-blue-200 bg-white/60" 
                               required 
                               autofocus/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password"
                               name="password"
                               placeholder="Password" 
                               class="!rounded-button w-full pl-10 pr-4 py-3 border border-blue-300 focus:border-blue-600 focus:ring focus:ring-blue-200 bg-white/60" 
                               required/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="remember"
                                   class="!rounded-button form-checkbox text-blue-600 border-gray-300 focus:ring-blue-600"/>
                            <span class="ml-2 text-gray-600">Remember Me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-500">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="!rounded-button w-full py-3 bg-blue-600 text-white font-semibold hover:opacity-90 transition-opacity">
                        Login
                    </button>

                    @if (Route::has('register'))
                        <p class="text-center text-gray-600">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500">Sign up</a>
                        </p>
                    @endif
                </form>
            </div>
        </main>

        <footer class="absolute bottom-0 w-full py-4 text-center text-gray-600 text-sm">
            <p>© 2024 Skybeacon. All Rights Reserved.</p>
        </footer>
    </x-guest-layout>
</body>
</html>