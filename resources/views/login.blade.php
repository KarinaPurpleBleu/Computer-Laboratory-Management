<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLMS Portal | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-blue: #00c3ff;
            --light-blue: #b5eeff;
        }
        .bg-primary { background-color: var(--primary-blue); }
        .text-primary { color: var(--primary-blue); }
        .form-card { animation: fadeIn 0.8s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden font-sans bg-[#b5eeff]">

    <div class="hidden lg:flex flex-col items-center justify-center w-1/2 bg-primary text-white p-12">
        <div class="text-center">
            <div class="mb-6 flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="CLMS Logo" class="w-48 h-48 object-contain drop-shadow-lg">
            </div>
            <h1 class="text-4xl font-bold tracking-tight uppercase">CLMS Portal</h1>
            <p class="mt-4 text-lg opacity-90 italic">Efficiently managing computer laboratories since heian era.</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8">
        <div class="w-full max-w-md bg-white p-10 rounded-xl shadow-2xl border border-gray-100 form-card">
            <h2 class="text-2xl font-bold text-primary">Welcome Back</h2>
            <p class="text-sm text-gray-500 mb-8">Please enter your lab credentials to continue.</p>

            <form action="#" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Email</label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] focus:border-[#00c3ff] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] focus:border-[#00c3ff] outline-none transition-all">
                </div>
                <button type="submit" class="w-full py-3 bg-primary text-white font-bold rounded hover:bg-[#0099cc] transition duration-200 uppercase text-xs tracking-widest shadow-lg">Log in to System</button>
            </form>
            <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-600 text-sm">No account? <span class="font-bold text-primary">Create one!</span></p>
                <a href="{{ url('/signup') }}" class="mt-4 inline-block px-8 py-2 border-2 border-primary text-primary font-bold rounded-md hover:bg-primary hover:text-white transition duration-300 transform hover:scale-105">GO TO SIGN UP</a>
            </div>
        </div>
    </div>
</body>
</html>
