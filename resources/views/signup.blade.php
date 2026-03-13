<!DOCTYPE html>
=======
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLMS Portal | Join Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --maroon: #800000; --cream: #FFFDD0; }
        .bg-maroon { background-color: var(--maroon); }
        .text-maroon { color: var(--maroon); }
        .form-card { animation: slideIn 0.6s ease-out; }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden font-sans bg-[#FFFDD0]">

    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8">
        <div class="w-full max-w-md bg-white p-10 rounded-xl shadow-2xl border border-gray-100 form-card">
            <h2 class="text-2xl font-bold text-maroon">Create Account</h2>
            <p class="text-sm text-gray-500 mb-8">Join the CLMS Portal to access lab resources.</p>

            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-maroon uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-maroon focus:border-maroon outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-maroon uppercase tracking-wider mb-1">University Email</label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-maroon focus:border-maroon outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-maroon uppercase tracking-wider mb-1">Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-maroon focus:border-maroon outline-none">
                </div>
                
                <button type="submit" class="w-full py-3 bg-maroon text-white font-bold rounded hover:bg-red-900 transition duration-200 uppercase text-xs tracking-widest shadow-lg">
                    Register Account
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-600 text-sm">Already a member?</p>
                <a href="{{ url('/login') }}" class="mt-4 inline-block px-8 py-2 border-2 border-maroon text-maroon font-bold rounded-md hover:bg-maroon hover:text-white transition duration-300 transform hover:scale-105 uppercase text-xs">
                Return to Log In
                </a>
            </div>
        </div>
    </div>

    <div class="hidden lg:flex flex-col items-center justify-center w-1/2 bg-maroon text-[#FFFDD0] p-12">
        <div class="text-center">
             <svg class="w-24 h-24 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <h1 class="text-4xl font-bold tracking-tight uppercase">Join the Portal</h1>
            <p class="mt-4 text-lg opacity-80 italic text-center">Your gateway to advanced computer laboratory management.</p>
        </div>
    </div>

</body>
</html>
>>>>>>> 0b12bf4 (Initial commit)
