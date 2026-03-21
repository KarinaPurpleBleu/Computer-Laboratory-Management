<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLMS Portal | Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-blue: #00c3ff;
            --light-blue: #b5eeff;
        }
        .bg-primary { background-color: var(--primary-blue); }
        .text-primary { color: var(--primary-blue); }
        .form-card { animation: slideIn 0.6s ease-out; }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden font-sans bg-[#b5eeff]">

    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8">
        <div class="w-full max-w-md bg-white p-10 rounded-xl shadow-2xl border border-gray-100 form-card">
            <h2 class="text-2xl font-bold text-primary">Join the Portal</h2>
            <p class="text-sm text-gray-500 mb-8">Register to start managing your lab tasks.</p>

            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" placeholder="Enter your full name" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Email</label>
                    <input type="email" placeholder="Enter your email" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Password</label>
                    <input type="password" placeholder="Enter your password" required pattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] outline-none transition-all">
                </div>
                <button type="submit" class="w-full py-3 bg-primary text-white font-bold rounded hover:bg-[#0099cc] transition duration-200 uppercase text-xs tracking-widest shadow-lg">
                    Register Account
                </button>
            </form>

            <div class="mt-8 pt-4 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600 italic">Already a member? 
                    <a href="{{ url('/login') }}" class="text-primary font-bold hover:underline">Log In</a>
                </p>
            </div>
        </div>
    </div>

    <div class="hidden lg:flex flex-col items-center justify-center w-1/2 bg-primary text-white p-12">
        <div class="text-center">
             <img src="{{ asset('images/logo.png') }}" alt="CLMS Logo" class="w-48 h-48 mx-auto mb-6 object-contain drop-shadow-lg">
            <h1 class="text-4xl font-bold tracking-tight uppercase">New Journey</h1>
            <p class="mt-4 text-lg opacity-90 italic">Creating a more efficient workspace for everyone.</p>
        </div>
    </div>

</body>
</html>