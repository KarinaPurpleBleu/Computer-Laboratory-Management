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
        .form-card { animation: fadeIn 0.8s ease-out; }
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
            <h2 class="text-2xl font-bold text-primary">Create Account</h2>
            <p class="text-sm text-gray-500 mb-8">Register to start managing your lab tasks.</p>
            <form action="{{ url('/signup') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Full Name</label>
                    <input name="name" type="text" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] outline-none transition-all">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] outline-none transition-all">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">Password</label>
                    <input name="password" type="password" required class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-[#00c3ff] outline-none transition-all">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="button" id="toggleAgreement" class="w-full py-2 bg-white text-gray-700 font-semibold rounded border border-gray-200 hover:bg-gray-50 transition duration-200 uppercase text-xs tracking-widest">
                        View User Agreement
                    </button>

                    <div id="agreementContent" class="hidden mt-3 max-h-60 overflow-y-auto border border-gray-200 rounded p-4 text-xs text-gray-700 bg-gray-50">
                        <h3 class="font-semibold text-primary">User Agreement</h3>

                        <p class="text-gray-600 text-sm mb-6">
                            Welcome to the Computer Laboratory Management System (CLMS)!  
                            Before proceeding please read thoroughly the following terms and conditions. By clicking "Register Account", you acknowledge that you have read, understood, and agree to be bound by this User Agreement. If you do not agree to these terms, please do not use the CLMS Portal.
                        </p>

                        <p class="text-gray-600 text-sm mb-4">
                            CLMS automatically records your personal information as the last user during your session. By this, we will identify who's gonna be the responsible for any damages, missing parts, or issues before you log out. This agreement outlines your responsibilities and the rules you must follow while using the CLMS Portal and its associated computer laboratories.
                        </p>

                        <div class="space-y-4 text-sm text-gray-700">

                            <div>
                                <h3 class="font-semibold text-primary">User Eligibility</h3>
                                <p>
                                    Open to all users: students, visitors, and guests.
                                    No age restrictions.
                                    One login per person—no sharing credentials.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-semibold text-primary">How Tracking Works</h3>
                                <p>
                                    Upon login, CLMS links your name and timestamp to that specific computer.
                                    You remain the last user until you properly log out.
                                    Logs are stored securely and privately keep for 30 days or until any issues are resolved.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-semibold text-primary">User Responsibilities</h3>
                                <p>
                                    As the last user, you are fully responsible for any damages, loss, or any issues during your time. And you should log out completely when finished.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-semibold text-primary">Equipment Accountability</h3>
                                <p>
                                    Any damage — scratched keyboards, cracked screens, etc. found after your time will be traced to you as the last user.
                                    You may fines, ban, or repair cost liability.
                                    Examples of accountable issues: spills, physical damage, removed parts, or malware infections.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-semibold text-primary">Prohibited Actions</h3>
                                <p>
                                    Tampering with hardware, login screens, or tracking features.
                                    Installing unauthorized software or running disruptive programs.
                                    Covering cameras, sensors, or labels.
                                    Leaving sessions logged in for others to use.
                                    Violations result in immediate access ban and full liability.
                                </p>
                            </div>

                            <div>
                                <h3 class="font-semibold text-primary">Data Privacy (Republic Act No. 10173)</h3>
                                <p>
                                    We collect only your name, timestamps, and user's computer number for accountability purposes, in full compliance with Republic Act No. 10173 (Data Privacy Act of 2012).
                                    Data is confidential and only the lab admin has authorized for monitoring, used only for maintenance, tracing, and deleted after 30 days.
                                    You consent to this processing by logging in.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <label class="flex items-start gap-2 text-sm text-gray-700 mt-4">
                    <input type="checkbox" name="agree" id="agree" class="accent-[#00c3ff] mt-1" required>
                    <span>I have read and agree to the <a href="{{ url('/user-agreement') }}" target="_blank" class="text-primary hover:underline">User Agreement</a>.</span>
                </label>
                @error('agree')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full py-3 bg-primary text-white font-bold rounded hover:bg-[#0099cc] transition duration-200 uppercase text-xs tracking-widest shadow-lg">Register Account</button>
            </form>
            <div class="mt-8 pt-4 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600 italic">Already a member? <a href="{{ url('/login') }}" class="text-primary font-bold hover:underline">Log In</a></p>
            </div>
        </div>
    </div>
<script>
    const toggleBtn = document.getElementById('toggleAgreement');
    const agreementContent = document.getElementById('agreementContent');
    let agreementVisible = false;

    toggleBtn.addEventListener('click', () => {
        agreementVisible = !agreementVisible;
        agreementContent.classList.toggle('hidden', !agreementVisible);
        toggleBtn.textContent = agreementVisible ? 'Hide User Agreement' : 'View User Agreement';
    });
</script>

</body>
</html>
