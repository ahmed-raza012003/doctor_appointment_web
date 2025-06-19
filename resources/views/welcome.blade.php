<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Clinic Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; font-family: Arial, sans-serif;">
    <div style="text-align: center;">
        <h1 style="font-size: 2.5rem; font-weight: bold; color: #1f2937; margin-bottom: 1.5rem;">Welcome to Clinic Management</h1>
        <div style="display: flex; justify-content: center; gap: 1rem;">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #2563eb; color: #ffffff; font-weight: 600; text-decoration: none; border-radius: 0.5rem; transition: background-color 0.2s;">Login</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #16a34a; color: #ffffff; font-weight: 600; text-decoration: none; border-radius: 4px; transition: background-color 0.2s;">Signup</a>
            @endif
        </div>
    </div>
</body>
</html>