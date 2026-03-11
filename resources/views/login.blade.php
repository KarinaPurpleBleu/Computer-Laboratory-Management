<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLMS Portal | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --maroon: #800000;
            --cream: #FFFDD0;
        }
        .bg-maroon { background-color: var(--maroon); }
        .text-maroon { color: var(--maroon); }
        .border-maroon { border-color: var(--maroon); }
        .focus-maroon:focus { border-color: var(--maroon); ring-color: var(--maroon); }
        
        .form-card {
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden font-sans bg-[#FFFDD0]">

    <div class="hidden lg:flex flex-col items-center justify-center w-1/2 bg-maroon text-[#FFFDD0] p-12">
        <div class="text-center">
            <div class="mb-6 flex justify-center">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold tracking-tight uppercase">CLMS Portal</h1>
            <p class="mt-4 text-lg opacity-80 italic">Efficiently managing computer laboratories since heian era.</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8">
        <div class="w-full max-w-md bg-white p-10 rounded-xl shadow-2xl border border-gray-100 form-card">
            <h2 class="text-2xl font-bold text-maroon">Welcome Back</h2>
            <p class="text-sm text-gray-500 mb-8">Please enter your lab credentials to continue.</p>

            <form action="#" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-maroon uppercase tracking-wider mb-1">Student / Faculty Email</label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-maroon focus:border-maroon outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-maroon uppercase tracking-wider mb-1">Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-maroon focus:border-maroon outline-none transition-all">
                </div>
                <button type="submit" class="w-full py-3 bg-maroon text-white font-bold rounded hover:bg-red-900 transition duration-200 uppercase text-xs tracking-widest shadow-lg">
                    Log in to System
                </button>
            </form>

            <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-600 text-sm">No account? <span class="font-bold text-maroon">Create one!</span></p>
                <a href="/signup" class="mt-4 inline-block px-8 py-2 border-2 border-maroon text-maroon font-bold rounded-md hover:bg-maroon hover:text-white transition duration-300 transform hover:scale-105">
                    GO TO SIGN UP
                </a>
            </div>
        </div>
    </div>
</body>
</html>