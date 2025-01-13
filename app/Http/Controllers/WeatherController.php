<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
    }

    public function getCurrentWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string'
        ]);

        try {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $request->city,
                'appid' => $this->apiKey
            ]);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch weather data'], 500);
        }
    }

    public function getForecast(Request $request)
    {
        $request->validate([
            'city' => 'required|string'
        ]);

        try {
            $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
                'q' => $request->city,
                'appid' => $this->apiKey
            ]);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch forecast data'], 500);
        }
    }
}
