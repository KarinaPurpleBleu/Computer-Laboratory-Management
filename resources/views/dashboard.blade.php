<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLMS | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root { --primary-blue: #00c3ff; }
        .text-primary { color: var(--primary-blue); }
        .bg-primary { background-color: var(--primary-blue); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 font-sans" x-data="{ view: 'home' }">

    <header class="bg-white border-b p-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" class="w-8 h-8 object-contain">
            <span class="font-bold text-xl text-slate-800">CLMS</span>
        </div>
        <div class="flex items-center gap-4">
            <button class="text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
            <div class="w-8 h-8 bg-primary rounded-full border-2 border-white shadow-sm overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}&background=00c3ff&color=fff" alt="Profile">
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto p-6 pb-24">
        
        <div x-show="view === 'home'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900">Welcome back, {{ Auth::user()->name ?? 'Lance' }}.</h1>
            <p class="text-slate-500 mb-8">Your workstation is ready for your next project.</p>

            <div class="bg-[#0081a7] rounded-2xl p-8 text-white relative overflow-hidden shadow-lg mb-8">
                <div class="flex items-center gap-2 mb-4">
                    <span class="h-2 w-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest opacity-80">Active Session</span>
                </div>
                <h2 class="text-2xl font-bold">Workstation PC-042</h2>
                <p class="opacity-70 text-sm">Main Wing - Lab A</p>
                <div class="flex gap-10 mt-6">
                    <div><p class="text-[10px] uppercase opacity-60">Time Elapsed</p><p class="text-xl font-mono">01:42:15</p></div>
                    <div><p class="text-[10px] uppercase opacity-60">Network Load</p><p class="text-xl font-mono">12.4 Mbps</p></div>
                </div>
                <button class="absolute bottom-8 right-8 bg-white text-[#0081a7] px-6 py-2 rounded-lg font-bold text-sm hover:bg-slate-100 transition shadow-md">End Session</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div class="bg-[#2d333b] rounded-xl p-6 font-mono text-xs text-slate-300 shadow-inner">
                    <div class="flex gap-1.5 mb-4">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                    </div>
                    <p><span class="text-white">user@CLMS:~$</span> session --status</p>
                    <p class="text-slate-500">>> Status: Authenticated</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl border border-slate-200">
                    <h3 class="font-bold mb-4">Lab Availability</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between text-xs font-bold"><span>Main Lab A</span><span class="text-primary">12 Free</span></div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full"><div class="bg-primary h-full w-2/3"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="view === 'pcs'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Available PCs</h1>
            <p class="text-slate-500 mb-8">Select a station to reserve or start a session.</p>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @for ($i = 1; $i <= 12; $i++)
                <div class="bg-white border-2 border-transparent hover:border-primary p-4 rounded-xl text-center transition cursor-pointer shadow-sm group">
                    <div class="w-12 h-12 bg-slate-50 rounded-full mx-auto mb-3 flex items-center justify-center text-slate-400 group-hover:text-primary transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="font-bold text-slate-700">PC-{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-[10px] text-green-500 font-bold uppercase mt-1">Ready</p>
                </div>
                @endfor
            </div>
        </div>

        <div x-show="view === 'history'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Session History</h1>
            <p class="text-slate-500 mb-8">Detailed log of your lab activity.</p>
            
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Unit</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Lab</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="hover:bg-blue-50/50">
                            <td class="px-6 py-4 font-bold text-slate-700">PC-012</td>
                            <td class="px-6 py-4 text-slate-500">Coding Suite B</td>
                            <td class="px-6 py-4 text-slate-500">Yesterday, 14:20</td>
                            <td class="px-6 py-4 font-mono">2h 25m</td>
                            <td class="px-6 py-4"><span class="bg-slate-100 text-slate-500 px-2 py-0.5 rounded text-[10px] font-bold">Finalized</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t p-2 flex justify-around items-center z-30 shadow-[0_-4px_10px_rgba(0,0,0,0.05)]">
        <button @click="view = 'home'" :class="view === 'home' ? 'text-primary' : 'text-slate-400'" class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path></svg>
            <span class="text-[10px] font-bold mt-1">Dashboard</span>
        </button>
        <button @click="view = 'pcs'" :class="view === 'pcs' ? 'text-primary' : 'text-slate-400'" class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span class="text-[10px] font-bold mt-1">PCs</span>
        </button>
        <button @click="view = 'history'" :class="view === 'history' ? 'text-primary' : 'text-slate-400'" class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-[10px] font-bold mt-1">History</span>
        </button>
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex flex-col items-center p-2 text-slate-400 hover:text-red-500 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="text-[10px] font-bold mt-1">Logout</span>
            </button>
        </form>
    </nav>

</body>
</html>