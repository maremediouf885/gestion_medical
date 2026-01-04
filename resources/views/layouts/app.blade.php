<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(rgba(30, 58, 138, 0.9), rgba(220, 38, 127, 0.8)), 
                           url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="medical" patternUnits="userSpaceOnUse" width="100" height="100"><circle cx="50" cy="50" r="2" fill="%23ffffff" opacity="0.1"/><path d="M45 40h10v20h-10z" fill="%23ffffff" opacity="0.05"/><path d="M40 45h20v10h-20z" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100%25" height="100%25" fill="url(%23medical)"/></svg>');
                background-size: cover, 100px 100px;
                background-attachment: fixed;
                min-height: 100vh;
            }
            .medical-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(15px);
                border: 2px solid rgba(59, 130, 246, 0.3);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
                transition: all 0.4s ease;
            }
            .medical-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 35px 70px rgba(0, 0, 0, 0.2);
                border-color: rgba(59, 130, 246, 0.5);
            }
            .btn-primary {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                padding: 12px 24px;
                border-radius: 12px;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border: none;
                box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(59, 130, 246, 0.6);
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            }
            .btn-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: white;
                padding: 12px 24px;
                border-radius: 12px;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border: none;
                box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
                transition: all 0.3s ease;
            }
            .btn-danger:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(239, 68, 68, 0.6);
                background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            }
            .btn-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
                padding: 12px 24px;
                border-radius: 12px;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border: none;
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
                transition: all 0.3s ease;
            }
            .btn-success:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(16, 185, 129, 0.6);
                background: linear-gradient(135deg, #059669 0%, #047857 100%);
            }
            .pulse-medical {
                animation: pulseMedical 2s infinite;
            }
            @keyframes pulseMedical {
                0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
                50% { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(59, 130, 246, 0); }
            }
            .fade-in-up {
                animation: fadeInUp 0.8s ease-out;
            }
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(50px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .medical-nav {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.9) 0%, rgba(220, 38, 127, 0.9) 100%);
                backdrop-filter: blur(20px);
                border-bottom: 2px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }
            .medical-input {
                background: rgba(255, 255, 255, 0.9);
                border: 2px solid rgba(59, 130, 246, 0.3);
                border-radius: 12px;
                padding: 12px 16px;
                transition: all 0.3s ease;
            }
            .medical-input:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
                background: rgba(255, 255, 255, 1);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="medical-nav shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center text-white">
                            <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4 pulse-medical">
                                <i class="fas fa-heartbeat text-2xl"></i>
                            </div>
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="fade-in-up">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
