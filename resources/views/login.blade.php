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

        .bg-primary {
            background-color: var(--primary-blue);
        }

        .text-primary {
            color: var(--primary-blue);
        }

        .form-card {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] focus:border-[#00c3ff] outline-none transition-all">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 pr-12 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] focus:border-[#00c3ff] outline-none transition-all">
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full py-3 bg-primary text-white font-bold rounded hover:bg-[#0099cc] transition duration-200 uppercase text-xs tracking-widest shadow-lg">Log
                    in to System</button>
            </form>
            <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-600 text-sm">No account? <span class="font-bold text-primary">Create one!</span></p>
                <a href="{{ url('/signup') }}"
                    class="mt-4 inline-block px-8 py-2 border-2 border-primary text-primary font-bold rounded-md hover:bg-primary hover:text-white transition duration-300 transform hover:scale-105">GO
                    TO SIGN UP</a>
            </div>
        </div>
    </div>
    <script>
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.innerHTML = type === 'password' ?
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>' :
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path></svg>';
        });
    </script>
</body>

</html>
