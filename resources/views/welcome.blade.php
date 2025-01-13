<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <x-guest-layout>
        <!-- Add Google Fonts via CDN in your layout file -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
        <div class="min-h-screen bg-gradient-to-r from-[#e2e2e2] to-[#c9d6ff] flex items-center justify-center px-4">
            <div class="bg-white rounded-[30px] shadow-[0_5px_15px_rgba(0,0,0,0.35)] relative overflow-hidden w-[768px] max-w-full min-h-[480px] font-[Montserrat]">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
    
                <div class="form-container sign-in absolute top-0 left-0 h-full w-1/2 z-[2] transition-all duration-600 ease-in-out">
                    <form method="POST" action="{{ route('login') }}" class="bg-white flex flex-col items-center justify-center h-full px-10">
                        @csrf
                        <h1 class="text-2xl font-bold mb-4">Welcome Back!</h1>
                        
                        <!-- Email Address -->
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="Email"
                            class="bg-[#eee] border-none my-2 px-4 py-2.5 text-sm rounded-lg w-full outline-none"
                            :value="old('email')"
                            required 
                            autofocus 
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    
                        <!-- Password -->
                        <input 
                            type="password"
                            name="password"
                            placeholder="Password"
                            class="bg-[#eee] border-none my-2 px-4 py-2.5 text-sm rounded-lg w-full outline-none"
                            required 
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    
                        <!-- Remember Me -->
                        <div class="flex items-center mt-4">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember_me"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm" 
                            />
                            <label class="ml-2 text-sm text-gray-600" for="remember_me">Remember me</label>
                        </div>
    
                        <!-- Forgot Password -->
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-gray-800 no-underline mt-4 hover:text-gray-600">
                                Forgot your password?
                            </a>
                        @endif
    
                        <button type="submit" class="bg-[#512da8] text-white text-xs px-11 py-2.5 border border-transparent rounded-lg font-semibold tracking-wider uppercase mt-4 cursor-pointer hover:bg-[#4527a0] transition-colors">
                            Sign In
                        </button>
                    </form>
                </div>
    
                <!-- Toggle Container -->
                <div class="absolute top-0 left-1/2 w-1/2 h-full overflow-hidden transition-all duration-600 ease-in-out rounded-l-[150px] z-[1000]">
                    <div class="bg-gradient-to-r from-[#5c6bc0] to-[#512da8] h-full relative -left-full w-[200%] transform transition-all duration-600 ease-in-out">
                        <div class="absolute w-1/2 h-full flex flex-col items-center justify-center px-8 text-center top-0 right-0 transition-all duration-600 ease-in-out">
                            <h1 class="text-white text-2xl font-bold mb-4">Hello!</h1>
                            <p class="text-white text-sm leading-5 tracking-wide mb-8">
                                Register with your personal details to use all of site features
                            </p>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="border border-white text-white text-xs px-11 py-2.5 rounded-full font-semibold tracking-wider uppercase hover:bg-white hover:text-[#512da8] transition-colors">
                                    Sign Up
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </x-guest-layout> 
</body>
</html>