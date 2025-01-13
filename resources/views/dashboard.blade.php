<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center bg-transparent bg-opacity-0">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
            </svg>
            {{ __('Weather Forecast') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-12" style="background-image: url('{{ asset('images/clouds2.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 dark:bg-gray-800/10 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="mb-8">
                        <label for="city" class="block text-lg font-medium mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Search City
                        </label>
                        <div class="flex gap-3">
                            <input type="text" id="city" 
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm block w-full transition-all duration-200 ease-in-out"
                                placeholder="Enter city name (e.g., London, Tokyo, New York)">
                            <button onclick="getForecast()" 
                                class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200 ease-in-out flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>
                        </div>
                    </div>

                    <div id="forecastResult" class="mt-8 hidden transform transition-all duration-500 ease-in-out">
                        <h3 class="text-xl font-semibold mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            24-Hour Forecast (3-hour intervals)
                        </h3>
                        <div id="forecastData" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pembayaran -->
    <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Upgrade to Premium</h3>
                <div class="mt-2 px-7 py-3">
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-4">
                        <p class="text-lg font-semibold">Premium Features:</p>
                        <ul class="text-left text-sm mt-2 space-y-2">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Full 24-hour forecast access
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Detailed weather information
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                No advertisements
                            </li>
                        </ul>
                    </div>
                    <p class="text-xl font-bold mb-4">Price: $9.99/month</p>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-left mb-2">Payment Method</label>
                            <select id="paymentMethod" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        
                        <div id="bankDetails" class="text-left bg-blue-50 dark:bg-blue-900/30 p-3 rounded-md">
                            <p class="font-semibold">Bank Transfer Details:</p>
                            <p>Bank: Example Bank</p>
                            <p>Account: 1234-5678-9012</p>
                            <p>Name: Weather App</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center gap-4 mt-4">
                    <button onclick="submitPayment()" 
                        class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Confirm Payment
                    </button>
                    <button onclick="closePaymentModal()" 
                        class="px-4 py-2 bg-gray-400 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function getForecast() {
            const city = document.getElementById('city').value;
            const resultDiv = document.getElementById('forecastResult');
            const forecastData = document.getElementById('forecastData');

            try {
                resultDiv.classList.add('opacity-50');
                const response = await fetch(`/weather/forecast?city=${encodeURIComponent(city)}`);
                const data = await response.json();

                if (data.error) {
                    forecastData.innerHTML = `
                        <div class="col-span-full text-center">
                            <div class="bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 p-4 rounded-lg">
                                <p class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    ${data.error}
                                </p>
                            </div>
                        </div>
                    `;
                } else {
                    const forecasts = data.list.slice(0, 8);
                    
                    forecastData.innerHTML = forecasts.map((forecast, index) => {
                        const temp = (forecast.main.temp - 273.15).toFixed(1);
                        const time = new Date(forecast.dt * 1000).toLocaleTimeString('en-US', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        const date = new Date(forecast.dt * 1000).toLocaleDateString('en-US', {
                            month: 'short',
                            day: 'numeric'
                        });
                        
                        const cardContent = `
                            <div class="text-sm font-semibold mb-3">${date} ${time}</div>
                            <div class="flex items-center justify-between mb-4">
                                <img src="https://openweathermap.org/img/wn/${forecast.weather[0].icon}@2x.png" 
                                     alt="${forecast.weather[0].description}"
                                     class="w-16 h-16 transform hover:scale-110 transition-transform duration-200">
                                <span class="text-3xl font-bold">${temp}°C</span>
                            </div>
                            <div class="text-sm space-y-2">
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                    </svg>
                                    ${forecast.weather[0].main}
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707"></path>
                                    </svg>
                                    Humidity: ${forecast.main.humidity}%
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Wind: ${forecast.wind.speed} m/s
                                </p>
                            </div>
                        `;

                        @if(auth()->user()->user_role === 'free')
                            if (index > 0) {
                                return `
                                    <div class="bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm p-6 rounded-xl relative shadow-lg transform hover:scale-105 transition-all duration-300 ease-in-out">
                                        <div class="absolute inset-0 backdrop-blur-sm bg-gray-500/30 rounded-xl flex items-center justify-center z-10">
                                            <button onclick="upgradeToPremium()" 
                                                class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-white font-bold py-3 px-6 rounded-lg shadow-xl transform hover:scale-105 transition-all duration-200 ease-in-out flex items-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Purchase Premium
                                            </button>
                                        </div>
                                        ${cardContent}
                                    </div>
                                `;
                            }
                        @endif

                        return `
                            <div class="bg-white/90 dark:bg-gray-700/90 backdrop-blur-sm p-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 ease-in-out">
                                ${cardContent}
                            </div>
                        `;
                    }).join('');
                }
                resultDiv.classList.remove('hidden', 'opacity-50');
            } catch (error) {
                forecastData.innerHTML = `
                    <div class="col-span-full text-center">
                        <div class="bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 p-4 rounded-lg">
                            <p class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Failed to fetch forecast data
                            </p>
                        </div>
                    </div>
                `;
                resultDiv.classList.remove('hidden');
            }
        }

        function upgradeToPremium() {
            document.getElementById('paymentModal').classList.remove('hidden');
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }

        function submitPayment() {
            const paymentMethod = document.getElementById('paymentMethod').value;
            
            // Simulate payment submission
            fetch('/submit-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    payment_method: paymentMethod,
                    amount: 9.99
                })
            })
            .then(response => response.json())
            .then(data => {
                alert('Payment submitted! Please wait for admin confirmation.');
                closePaymentModal();
            })
            .catch(error => {
                alert('Error submitting payment. Please try again.');
            });
        }

        // Payment method change handler
        document.getElementById('paymentMethod').addEventListener('change', function(e) {
            const bankDetails = document.getElementById('bankDetails');
            if (e.target.value === 'bank_transfer') {
                bankDetails.classList.remove('hidden');
            } else {
                bankDetails.classList.add('hidden');
            }
        });

        // Add event listener for Enter key
        document.getElementById('city').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                getForecast();
            }
        });
    </script>
</x-app-layout>
